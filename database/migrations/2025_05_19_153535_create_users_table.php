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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Dados principais
            $table->string('name');
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            // Perfil
            $table->string('profile_slug', 150)->unique()->nullable();
            $table->string('profile_image_url')->nullable();
            $table->date('birth_date')->nullable();

            // Contato
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();

            // Endereço
            $table->string('address')->nullable();
            $table->string('neighborhood', 150)->nullable();
            $table->string('state', 2)->nullable();
            $table->unsignedBigInteger('fk_city_id')->nullable();

            // Informações adicionais
            $table->text('bio')->nullable();
            $table->text('interests')->nullable();
            $table->boolean('show_bio')->default(true);
            $table->boolean('show_interests')->default(true);

            // Redes sociais
            $table->string('facebook_profile_url')->nullable();
            $table->string('instagram_profile_url')->nullable();
            $table->string('twitter_profile_url')->nullable();
            $table->string('youtube_profile_url')->nullable();

            // Estatísticas
            $table->integer('football_wins_count')->default(0);
            $table->integer('raffle_participations_count')->default(0);

            // Categoria e afiliação
            $table->enum('user_category', ['visitante', 'membro', 'lojista', 'vip'])->default('visitante');
            $table->unsignedBigInteger('fk_affiliate_tier_id')->nullable();
            $table->enum('status', ['ativo', 'inativo', 'bloqueado'])->default('ativo');
            $table->timestamp('last_login_at')->nullable();

            // Segurança e controle
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // Índices e chaves estrangeiras
            $table->index('username');
            $table->index('email');
            $table->index('profile_slug');
            $table->index('fk_city_id');
            $table->index('fk_affiliate_tier_id');

            // FKs
            $table->foreign('fk_city_id')->references('id')->on('cities')->nullOnDelete();
            $table->foreign('fk_affiliate_tier_id')->references('id')->on('affiliate_tiers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
