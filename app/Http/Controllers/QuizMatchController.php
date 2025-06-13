<?php

namespace App\Http\Controllers;

use App\Models\QuizMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizMatchController extends Controller
{
    public function index()
    {
        $jogos = QuizMatch::orderByDesc('match_date')
            ->orderByDesc('match_time')
            ->get();

        return view('admin.quiz.index', compact('jogos'));
    }

    public function create()
    {
        return redirect()->route('admin.quiz.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_home'     => 'required|string|max:255',
            'team_away'     => 'required|string|max:255',
            'match_date'    => 'required|date',
            'match_time'    => 'required',
            'escudo_home'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'escudo_away'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('escudo_home')) {
            $data['escudo_home'] = $request->file('escudo_home')->store('escudos', 'public');
        }

        if ($request->hasFile('escudo_away')) {
            $data['escudo_away'] = $request->file('escudo_away')->store('escudos', 'public');
        }

        QuizMatch::create($data);

        return redirect()->route('admin.quiz.index')->with('success', 'Jogo cadastrado com sucesso!');
    }

    public function edit(QuizMatch $quizMatch)
    {
        return view('admin.quiz.edit', compact('quizMatch'));
    }

    public function update(Request $request, QuizMatch $quizMatch)
    {
        $request->validate([
            'score_home' => 'required|integer|min:0',
            'score_away' => 'required|integer|min:0',
        ]);

        $quizMatch->update([
            'score_home' => $request->score_home,
            'score_away' => $request->score_away,
        ]);

        $quizMatch->calcularPontos();

        return redirect()->route('admin.quiz.index')->with('success', 'Placar atualizado com sucesso!');
    }

    public function resultado(QuizMatch $quizMatch)
    {
        $match = $quizMatch;
        $palpites = $match->palpites()->with('user.city')->get();

        $pontuacao3 = $palpites->filter(fn($p) =>
            $p->guess_score_home == $match->score_home &&
            $p->guess_score_away == $match->score_away
        );

        $ids3pts = $pontuacao3->pluck('id');

        $pontuacao1 = $palpites->filter(function ($p) use ($match, $ids3pts) {
            if ($ids3pts->contains($p->id)) return false;

            $resultadoReal     = $match->score_home <=> $match->score_away;
            $resultadoPalpite  = $p->guess_score_home <=> $p->guess_score_away;

            return $resultadoReal === $resultadoPalpite;
        });

        $idsPontuaram = $pontuacao3->pluck('id')->merge($pontuacao1->pluck('id'));

        $pontuacao0 = $palpites->filter(fn($p) =>
            !$idsPontuaram->contains($p->id)
        );

        return view('palpites.resultado', compact(
            'match',
            'pontuacao3',
            'pontuacao1',
            'pontuacao0'
        ));
    }
}
