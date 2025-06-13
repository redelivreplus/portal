<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quiz_palpites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('match_id')
                  ->constrained('quiz_matches')
                  ->onDelete('cascade');

            $table->integer('guess_score_home');
            $table->integer('guess_score_away');

            $table->integer('points')->default(0);

            $table->timestamps();

            $table->unique(['user_id', 'match_id']); // Evita múltiplos palpites no mesmo jogo por usuário
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_palpites');
    }
};
