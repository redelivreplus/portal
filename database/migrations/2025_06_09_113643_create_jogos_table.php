<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rodada_id')->constrained()->onDelete('cascade');
            $table->string('time_a');
            $table->string('time_b');
            $table->enum('resultado_oficial', ['time_a', 'empate', 'time_b'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('jogos');
    }
};
