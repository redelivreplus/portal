<?php

namespace Database\Seeders;

use App\Models\QuizMatch;
use App\Models\QuizPalpite;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuizMatchSeeder extends Seeder
{
public function run(): void
{
    $quizMatch = QuizMatch::create([
        'team_home' => 'Novorizontino',
        'team_away' => 'Goiás',
        'match_date' => now()->format('Y-m-d'),
        'match_time' => '23:25',
        'score_home' => 2,
        'score_away' => 1,
    ]);

    // Pega 100 usuários diferentes, ordenados aleatoriamente
    $users = User::inRandomOrder()->take(100)->get();

    // Para cada usuário, cria um palpite
    foreach ($users as $user) {
        QuizPalpite::create([
            'match_id' => $quizMatch->id,
            'user_id' => $user->id,
            'guess_score_home' => rand(0, 5),
            'guess_score_away' => rand(0, 5),
        ]);
    }
}

}
