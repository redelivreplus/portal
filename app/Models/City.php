<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Definindo o nome da tabela (caso a tabela não siga o padrão plural)
    protected $table = 'cities'; 

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'state',
        'slug',
    ];

    // Relacionamento com o model User
    public function users()
    {
        return $this->hasMany(User::class, 'fk_city_id');
    }
}
