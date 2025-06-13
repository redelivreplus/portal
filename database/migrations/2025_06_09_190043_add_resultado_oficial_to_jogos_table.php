<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->enum('resultado_oficial', ['time_a', 'time_b', 'empate'])->nullable()->after('time_b');
        });
    }

    public function down(): void
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->dropColumn('resultado_oficial');
        });
    }
};
