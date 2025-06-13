<?php

namespace Tests\Feature;

use App\Models\Palpite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PalpiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_palpite_creation(): void
    {
        $palpite = Palpite::factory()->create();

        $this->assertDatabaseHas('palpites', [
            'id' => $palpite->id,
            'quiz_match_id' => $palpite->quiz_match_id,
            'user_id' => $palpite->user_id,
        ]);
    }
}
