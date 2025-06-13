<?php

namespace App\Http\Controllers;

use App\Models\QuizMatch;
use App\Models\QuizPalpite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PalpiteController extends Controller
{
    /**
     * Exibe a lista de jogos disponíveis para palpitar, encerrados e em destaque
     */
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();

        $jogoDestaque = QuizMatch::whereNull('score_home')
            ->whereNull('score_away')
            ->orderByDesc('id')
            ->first();

        $jogosRestantes = QuizMatch::whereNull('score_home')
            ->whereNull('score_away')
            ->where(function ($query) use ($now) {
                $query->where('match_date', '>', $now->toDateString())
                      ->orWhere(function ($q) use ($now) {
                          $q->where('match_date', $now->toDateString())
                            ->where('match_time', '>', $now->toTimeString());
                      });
            })
            ->when($jogoDestaque, fn($query) => $query->where('id', '!=', $jogoDestaque->id))
            ->orderBy('match_date')
            ->orderBy('match_time')
            ->get();

        $jogosEncerradosTodos = QuizMatch::whereNotNull('score_home')
            ->whereNotNull('score_away')
            ->orderByDesc('match_date')
            ->orderByDesc('match_time')
            ->get();

        $ultimoEncerrado = $jogosEncerradosTodos->first();
        $jogosEncerrados = $jogosEncerradosTodos->slice(1);

        return view('palpites.index', compact(
            'user',
            'jogoDestaque',
            'jogosRestantes',
            'ultimoEncerrado',
            'jogosEncerrados'
        ));
    }

    /**
     * Armazena o palpite do usuário
     */
    public function store(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:quiz_matches,id',
            'guess_score_home' => 'required|integer|min:0',
            'guess_score_away' => 'required|integer|min:0',
        ]);

        $user = Auth::user();
        $match = QuizMatch::findOrFail($request->match_id);

        if ($match->jaComecou()) {
            return back()->withErrors(['msg' => 'Palpites só podem ser enviados antes do jogo começar.'])->withInput();
        }

        if ($user->jaPalpitou($match->id)) {
            return back()->withErrors(['msg' => 'Você já enviou um palpite para este jogo.'])->withInput();
        }

        QuizPalpite::create([
            'user_id' => $user->id,
            'match_id' => $match->id,
            'guess_score_home' => $request->guess_score_home,
            'guess_score_away' => $request->guess_score_away,
        ]);

        return redirect()->route('palpites.confirmacao', ['slug' => $match->slug]);
    }

    /**
     * Mostra a confirmação do palpite com base no slug do jogo
     */
    public function confirmacao($slug)
    {
        $match = QuizMatch::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        $palpite = QuizPalpite::where('user_id', $user->id)
            ->where('match_id', $match->id)
            ->with('match')
            ->firstOrFail();

        // Buscar outros palpites para o mesmo jogo, excluindo o do usuário atual
        $outrosPalpites = QuizPalpite::where('match_id', $match->id)
            ->where('user_id', '!=', $user->id)
            ->with('user.city') // relacionamento necessário para cidade
            ->orderByDesc('created_at')
            ->get();

        return view('palpites.confirmacao', compact('palpite', 'match', 'user', 'outrosPalpites'));
    }
}
