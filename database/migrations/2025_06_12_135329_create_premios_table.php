<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sorteio_id')->constrained()->onDelete('cascade');
            $table->integer('posicao'); // de 1 a 20
            $table->string('descricao');
            $table->boolean('premio_extra')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};
