<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('palpites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jogo_id')->constrained()->onDelete('cascade');
            $table->enum('palpite', ['A', 'E', 'B']);
            $table->timestamps();

            $table->unique(['user_id', 'jogo_id']); // evita palpites duplicados
        });
    }

    public function down(): void {
        Schema::dropIfExists('palpites');
    }
};
