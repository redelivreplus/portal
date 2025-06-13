<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('affiliate_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();        // Ex: Bronze, Prata, Ouro
            $table->text('description')->nullable();      // Descrição do plano
            $table->decimal('commission_rate', 5, 2)->default(0.00); // Comissão (%)
            $table->text('benefits')->nullable();         // Lista de benefícios
            $table->decimal('price', 10, 2)->default(0.00); // Valor do plano
            $table->boolean('is_active')->default(true);  // Se está ativo
            $table->timestamps();

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_tiers');
    }
};
