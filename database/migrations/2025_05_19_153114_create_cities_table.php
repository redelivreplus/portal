<?php

// database/migrations/0000_00_00_000000_create_cities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id(); // ⚠️ Importante: "id" deve ser unsignedBigInteger por padrão
            $table->string('name', 150);
            $table->char('state', 2);
            $table->string('slug', 150)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
