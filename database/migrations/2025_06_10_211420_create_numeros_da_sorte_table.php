<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('numeros_da_sorte', function (Blueprint $table) {
            $table->id();

            // Relacionamento com o usuário logado
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relacionamento com o sorteio atual
            $table->foreignId('sorteio_id')->constrained()->onDelete('cascade');

            // Número único de 7 dígitos
            $table->string('numero', 7)->unique();

            // Lógica do sistema
            $table->boolean('ativo')->default(true); // Ainda concorre?
            $table->boolean('premiado')->default(false); // Foi sorteado?
            $table->timestamp('gerado_em')->nullable(); // Quando foi gerado

            $table->timestamps();

            // Um número por usuário por sorteio
            $table->unique(['user_id', 'sorteio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('numeros_da_sorte');
    }
};
