<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'titulo',
        'premio_rodada',
        'quantidade_jogos',
        'status', // false = aberta, true = encerrada
    ];

    // Casts automáticos de tipo
    protected $casts = [
        'status' => 'boolean',
        'quantidade_jogos' => 'integer',
    ];

    /**
     * Relacionamento: uma rodada tem muitos jogos
     */
    public function jogos()
    {
        return $this->hasMany(Jogo::class);
    }
}
