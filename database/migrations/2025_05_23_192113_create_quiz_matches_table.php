<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_matches', function (Blueprint $table) {
            $table->id();
            $table->string('team_home');
            $table->string('team_away');
            $table->date('match_date');
            $table->time('match_time');
            $table->string('escudo_home')->nullable();
            $table->string('escudo_away')->nullable();
            $table->integer('score_home')->nullable();
            $table->integer('score_away')->nullable();
            $table->integer('placar_home')->nullable();  // coluna adicionada
            $table->integer('placar_away')->nullable();  // coluna adicionada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_matches');
    }
}
