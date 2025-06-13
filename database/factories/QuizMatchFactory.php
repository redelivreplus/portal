<?php

namespace Database\Factories;

use App\Models\QuizMatch;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizMatchFactory extends Factory
{
    protected $model = QuizMatch::class;

    public function definition(): array
    {
        return [
            'team_home' => $this->faker->word,
            'team_away' => $this->faker->word,
            'match_date' => $this->faker->dateTimeThisYear,
            'match_time' => $this->faker->time,
            'score_home' => $this->faker->numberBetween(0, 5),
            'score_away' => $this->faker->numberBetween(0, 5),
        ];
    }
}
