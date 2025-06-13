<?php

namespace Tests\Feature;

use App\Models\QuizMatch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizMatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_quiz_match_creation(): void
    {
        $quizMatch = QuizMatch::factory()->create();

        $this->assertDatabaseHas('quiz_matches', [
            'id' => $quizMatch->id,
            'team_home' => $quizMatch->team_home,
            'team_away' => $quizMatch->team_away,
        ]);
    }
}
