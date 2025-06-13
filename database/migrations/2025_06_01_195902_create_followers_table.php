<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();

            // Usuário que está seguindo
            $table->foreignId('follower_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Usuário que está sendo seguido
            $table->foreignId('followed_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

            // Impede duplicações (ex: mesmo usuário seguir duas vezes)
            $table->unique(['follower_id', 'followed_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
