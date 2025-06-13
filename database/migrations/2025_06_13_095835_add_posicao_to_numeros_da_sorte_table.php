<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPosicaoToNumerosDaSorteTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('numeros_da_sorte', function (Blueprint $table) {
            $table->unsignedTinyInteger('posicao')
                  ->nullable()
                  ->after('numero')
                  ->comment('Posição do prêmio (ex: 1 = 1º prêmio)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numeros_da_sorte', function (Blueprint $table) {
            $table->dropColumn('posicao');
        });
    }
}
