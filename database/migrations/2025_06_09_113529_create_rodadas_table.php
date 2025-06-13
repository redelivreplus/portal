<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rodadas', function (Blueprint $table) {
            $table->id();
            $table->string('premio_rodada');
            $table->unsignedInteger('quantidade_jogos');
            $table->boolean('status')->default(false); // false = aberta, true = encerrada
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rodadas');
    }
};
