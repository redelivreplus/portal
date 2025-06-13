<?php

namespace Database\Seeders;

use App\Models\QuizMatch;
use App\Models\QuizPalpite;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateMatchWithPalpitesSeeder extends Seeder
{
    public function run()
    {
        // Criar o jogo
        $quizMatch = QuizMatch::create([
            'team_home' => 'vila',
            'team_away' => 'Goiás',
            'match_date' => now()->format('Y-m-d'),
            'match_time' => '20:00',
            'score_home' => null,
            'score_away' => null,
        ]);

        // Pega todos os usuários
        $users = User::all();

        // Cria um palpite para cada usuário
        foreach ($users as $user) {
            QuizPalpite::create([
                'match_id' => $quizMatch->id,
                'user_id' => $user->id,
                'guess_score_home' => rand(0, 5),
                'guess_score_away' => rand(0, 5),
                'points' => 0,
            ]);
        }
    }
}
