<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sorteio extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'descricao', 'ativo'];

    protected $casts = [
        'data' => 'date',
        'ativo' => 'boolean',
    ];

    public function numeros()
    {
        return $this->hasMany(NumeroDaSorte::class);
    }

    public function premios()
    {
        return $this->hasMany(Premio::class)->orderBy('posicao');
    }
}
