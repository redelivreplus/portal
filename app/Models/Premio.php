<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Premio extends Model
{
    use HasFactory;

    protected $fillable = [
        'sorteio_id',
        'posicao',
        'descricao',
        'premio_extra',
    ];

    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class);
    }
}
