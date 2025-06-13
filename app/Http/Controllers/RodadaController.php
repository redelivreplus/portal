<?php

namespace App\Http\Controllers;

use App\Models\Rodada;
use App\Models\Jogo;
use App\Models\Palpite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RodadaController extends Controller
{
    public function index()
    {
        $rodadas = Rodada::orderByDesc('created_at')->get();
        return view('rodadas.index', compact('rodadas'));
    }

    public function create()
    {
        return view('rodadas.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRodada($request);

        $request->validate([
            'jogos' => 'required|array|min:1',
            'jogos.*.time_a' => 'required|string|max:255',
            'jogos.*.time_b' => 'required|string|max:255',
            'jogos.*.escudo_a' => 'nullable|image|max:2048',
            'jogos.*.escudo_b' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $rodada = Rodada::create($validated);

            foreach ($request->input('jogos') as $index => $jogo) {
                $escudoA = $request->file("jogos.$index.escudo_a");
                $escudoB = $request->file("jogos.$index.escudo_b");

                $escudoAPath = $escudoA ? $escudoA->store('escudos', 'public') : null;
                $escudoBPath = $escudoB ? $escudoB->store('escudos', 'public') : null;

                $rodada->jogos()->create([
                    'time_a' => $jogo['time_a'],
                    'time_b' => $jogo['time_b'],
                    'escudo_a' => $escudoAPath,
                    'escudo_b' => $escudoBPath,
                ]);
            }
        });

        return redirect()->route('rodadas.index')->with('success', 'Rodada e jogos criados com sucesso.');
    }

    public function show(Rodada $rodada)
    {
        $rodada->load('jogos');
        return view('rodadas.show', compact('rodada'));
    }

    public function edit(Rodada $rodada)
    {
        $rodada->load('jogos');
        return view('rodadas.edit', compact('rodada'));
    }

    public function finalizar(Request $request, Rodada $rodada)
    {
        if ($rodada->status) {
            return redirect()->route('rodadas.index')->with('error', 'Esta rodada já foi encerrada.');
        }

        $request->validate([
            'resultados' => 'required|array',
            'resultados.*' => 'in:time_a,time_b,empate'
        ]);

        DB::transaction(function () use ($rodada, $request) {
            foreach ($request->input('resultados') as $jogoId => $resultado) {
                $jogo = $rodada->jogos()->find($jogoId);

                if ($jogo) {
                    $jogo->update(['resultado_oficial' => $resultado]);

                    $jogo->palpites()->chunk(100, function ($palpites) use ($resultado) {
                        foreach ($palpites as $palpite) {
                            $oficial = match ($resultado) {
                                'time_a' => 'A',
                                'time_b' => 'B',
                                'empate' => 'E',
                            };

                            $acertou = $palpite->palpite === $oficial;

                            $palpite->acerto_exato = $acertou ? 1 : 0;
                            $palpite->acerto_resultado = $acertou ? 1 : 0;
                            $palpite->pontos = $acertou ? 3 : 0;
                            $palpite->save();
                        }
                    });
                }
            }

            $rodada->update(['status' => true]);
        });

        return redirect()->route('rodadas.index')->with('success', "Rodada '{$rodada->titulo}' encerrada com sucesso.");
    }

    public function destroy(Rodada $rodada)
    {
        if ($rodada->status) {
            return redirect()->route('rodadas.index')->with('error', 'Não é possível excluir uma rodada encerrada.');
        }

        $rodada->delete();
        return redirect()->route('rodadas.index')->with('success', 'Rodada excluída com sucesso.');
    }

    public function ranking(Rodada $rodada)
    {
        $usuarios = User::whereHas('palpitesRodada.jogo', function ($query) use ($rodada) {
            $query->where('rodada_id', $rodada->id);
        })->with(['palpitesRodada.jogo' => function ($query) use ($rodada) {
            $query->where('rodada_id', $rodada->id);
        }])->get();

        $ranking = $usuarios->map(function ($user) use ($rodada) {
            $palpites = $user->palpitesRodada->filter(function ($palpite) use ($rodada) {
                return $palpite->jogo && $palpite->jogo->rodada_id === $rodada->id;
            });

            return (object) [
                'user' => $user,
                'total_points' => $palpites->sum('pontos'),
                'exact_hits' => $palpites->where('acerto_exato', true)->count(),
                'result_hits' => $palpites->where('acerto_resultado', true)->count(),
            ];
        })->sortByDesc('total_points')->values();

        return view('rodadas.ranking', compact('rodada', 'ranking'));
    }

    private function validateRodada(Request $request): array
    {
        return $request->validate([
            'titulo' => 'required|string|max:255',
            'premio_rodada' => 'required|string|max:255',
            'quantidade_jogos' => 'required|integer|min:1|max:25',
            'status' => 'sometimes|boolean'
        ]);
    }
}
