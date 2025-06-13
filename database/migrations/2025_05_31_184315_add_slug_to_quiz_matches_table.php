<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToQuizMatchesTable extends Migration
{
    public function up()
    {
        Schema::table('quiz_matches', function (Blueprint $table) {
            $table->string('slug')->unique()->after('team_away');
        });
    }

    public function down()
    {
        Schema::table('quiz_matches', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
