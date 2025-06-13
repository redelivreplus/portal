<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;

    protected $table = 'canais';

    protected $fillable = [
        'nome',
        'cidade',
        'estado',
        'cep',
        'url',
        'logo',
        'responsavel',
        'telefone',
        'email',
        'funcao',
        'user_id'
    ];

    // Relacionamento com User (criador do canal)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
