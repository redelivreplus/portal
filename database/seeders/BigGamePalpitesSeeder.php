<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\QuizMatch;
use App\Models\QuizPalpite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BigGamePalpitesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Criando 100.000 usuários...');

        // Inserção em batch para performance
        $usersData = [];
        $now = now();

        for ($i = 0; $i < 100000; $i++) {
            $usersData[] = [
                'name' => 'User ' . $i,
                'username' => 'user' . $i,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($usersData) === 1000) {
                DB::table('users')->insert($usersData);
                $usersData = [];
            }
        }

        if (!empty($usersData)) {
            DB::table('users')->insert($usersData);
        }

        $this->command->info('Usuários criados.');

        $this->command->info('Criando partida...');

        $match = QuizMatch::create([
            'team_home' => 'Time Alpha',
            'team_away' => 'Time Beta',
            'match_date' => now()->toDateString(),
            'match_time' => '20:00',
            'score_home' => null,
            'score_away' => null,
        ]);

        $this->command->info('Gerando palpites...');

        User::chunk(1000, function ($users) use ($match) {
            $palpites = [];
            $now = now();

            foreach ($users as $user) {
                $palpites[] = [
                    'match_id' => $match->id,
                    'user_id' => $user->id,
                    'guess_score_home' => rand(0, 5),
                    'guess_score_away' => rand(0, 5),
                    'points' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('quiz_palpites')->insert($palpites);
        });

        $this->command->info('Palpites gerados com sucesso.');
    }
}
