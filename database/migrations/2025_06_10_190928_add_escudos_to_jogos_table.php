<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->string('escudo_a')->nullable()->after('time_a');
            $table->string('escudo_b')->nullable()->after('time_b');
        });
    }

    public function down(): void
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->dropColumn(['escudo_a', 'escudo_b']);
        });
    }
};
