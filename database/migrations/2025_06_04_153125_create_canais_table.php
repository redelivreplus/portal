<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanaisTable extends Migration
{
    public function up()
    {
        Schema::create('canais', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable(); // UF com 2 caracteres
            $table->string('cep', 9)->nullable();
            $table->string('url', 255); // URL da transmissão HLS
            $table->string('logo', 255); // Caminho da imagem

            // Campos adicionais de informações de contato
            $table->string('responsavel')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('funcao')->nullable();

            // Relacionamento com usuário criador
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('canais');
    }
}
