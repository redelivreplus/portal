<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rodadas', function (Blueprint $table) {
            if (!Schema::hasColumn('rodadas', 'premio_rodada')) {
                $table->string('premio_rodada')->after('titulo');
            }
            if (!Schema::hasColumn('rodadas', 'quantidade_jogos')) {
                $table->unsignedInteger('quantidade_jogos')->after('premio_rodada');
            }
            if (!Schema::hasColumn('rodadas', 'status')) {
                $table->boolean('status')->default(false)->after('quantidade_jogos');
            }
        });
    }

    public function down()
    {
        Schema::table('rodadas', function (Blueprint $table) {
            $table->dropColumn(['premio_rodada', 'quantidade_jogos', 'status']);
        });
    }
};
