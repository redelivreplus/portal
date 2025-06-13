<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('palpites', function (Blueprint $table) {
            $table->boolean('acerto_exato')->nullable();
            $table->boolean('acerto_resultado')->nullable();
            $table->integer('pontos')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('palpites', function (Blueprint $table) {
            $table->dropColumn(['acerto_exato', 'acerto_resultado', 'pontos']);
        });
    }
};
