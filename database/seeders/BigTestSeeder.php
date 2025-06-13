<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BigTestSeeder extends Seeder
{
    public function run(): void
    {
        $totalUsers = 100000;
        $batchSize = 1000;

        $this->command->info("Criando {$totalUsers} usuários...");

        for ($i = 0; $i < $totalUsers; $i += $batchSize) {
            $users = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $users[] = [
                    'name' => fake()->name(),
                    'username' => Str::slug(fake()->unique()->userName() . now()->timestamp),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('users')->insert($users);
            $this->command->info("Inseridos: " . ($i + $batchSize));
        }

        $this->command->info("✅ Inserção finalizada.");
    }
}
