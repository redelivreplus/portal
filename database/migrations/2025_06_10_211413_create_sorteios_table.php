<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sorteios', function (Blueprint $table) {
            $table->id();
            $table->date('data'); // Data programada do sorteio
            $table->string('descricao')->nullable(); // Ex: “Sorteio de Junho”
            $table->boolean('ativo')->default(true); // Define o sorteio atual
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sorteios');
    }
};
