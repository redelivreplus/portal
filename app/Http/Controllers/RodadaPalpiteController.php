<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rodada;
use App\Models\Jogo;
use App\Models\Palpite;
use Illuminate\Support\Facades\Auth;

class RodadaPalpiteController extends Controller
{
    /**
     * Salva os palpites do usuário autenticado para a rodada — apenas uma vez.
     */
    public function salvarPalpites(Request $request, Rodada $rodada)
    {
        $user = Auth::user();

        // Verifica se o usuário já enviou palpites para essa rodada
        $palpitesExistentes = Palpite::where('user_id', $user->id)
            ->whereIn('jogo_id', $rodada->jogos()->pluck('id'))
            ->exists();

        if ($palpitesExistentes) {
            return redirect()
                ->route('rodadas.confirmacao', $rodada)
                ->with('warning', 'Você já enviou seus palpites para esta rodada. Eles não podem ser alterados.');
        }

        // Valida os palpites
        $request->validate([
            'palpites' => 'required|array',
            'palpites.*' => 'in:A,B,E',
        ]);

        $palpites = $request->input('palpites');

        foreach ($palpites as $jogoId => $palpiteEscolhido) {
            $jogo = $rodada->jogos()->where('id', $jogoId)->first();
            if (!$jogo) continue;

            Palpite::create([
                'user_id' => $user->id,
                'jogo_id' => $jogo->id,
                'palpite' => $palpiteEscolhido,
            ]);
        }

        return redirect()
            ->route('rodadas.confirmacao', $rodada)
            ->with('success', 'Palpites enviados com sucesso! Agora é só torcer! ⚽');
    }

    /**
     * Exibe a confirmação dos palpites do usuário para uma rodada específica.
     */
    public function confirmacao(Rodada $rodada)
    {
        $user = Auth::user();

        $palpites = $rodada->jogos()
            ->with(['palpites' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->get();

        return view('rodadas.confirmacao', compact('rodada', 'palpites'));
    }
}
