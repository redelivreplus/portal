<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\QuizMatch;
use App\Models\QuizPalpite;

class QuizPalpiteFluminenseVascoSeeder extends Seeder
{
    public function run(): void
    {
        $match = QuizMatch::where('team_home', 'Fluminense')
                          ->where('team_away', 'Vasco')
                          ->latest()
                          ->first();

        if (!$match) {
            $this->command->error('Jogo Fluminense x Vasco não encontrado.');
            return;
        }

        $users = User::all();
        $this->command->info("Gerando palpites para {$users->count()} usuários...");

        foreach ($users as $user) {
            $exists = QuizPalpite::where('match_id', $match->id)
                                 ->where('user_id', $user->id)
                                 ->exists();

            if (!$exists) {
                QuizPalpite::create([
                    'match_id' => $match->id,
                    'user_id' => $user->id,
                    'guess_score_home' => rand(0, 5),
                    'guess_score_away' => rand(0, 5),
                ]);
            }
        }

        $this->command->info('Palpites gerados com sucesso para Fluminense x Vasco.');
    }
}
