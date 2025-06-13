<?php

namespace Database\Factories;

use App\Models\Palpite;
use Illuminate\Database\Eloquent\Factories\Factory;

class PalpiteFactory extends Factory
{
    protected $model = Palpite::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10000), // ID do usuário (ajuste conforme seu range)
            'quiz_match_id' => $this->faker->numberBetween(1, 1000), // ID do jogo ou quiz_match
            'palpite' => $this->faker->randomElement(['vitoria_flu', 'vitoria_vasco', 'empate']), // exemplo de palpites
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
