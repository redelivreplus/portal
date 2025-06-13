<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NumeroDaSorte extends Model
{
    use HasFactory;

    /**
     * Nome da tabela (caso não siga o padrão)
     */
    protected $table = 'numeros_da_sorte';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'user_id',
        'sorteio_id',
        'numero',
        'ativo',
        'premiado',
        'gerado_em',
		'posicao', // 👈 ADICIONE ESTA LINHA
    ];

    /**
     * Conversão de tipos de atributos
     */
    protected $casts = [
        'ativo' => 'boolean',
        'premiado' => 'boolean',
        'gerado_em' => 'datetime',
    ];

    /**
     * Relacionamento: número pertence a um usuário
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento: número pertence a um sorteio
     */
    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class);
    }

    /**
     * Accessor: retorna número formatado, exemplo 123-456-7
     */
    public function getNumeroFormatadoAttribute()
    {
        return chunk_split($this->numero, 3, '-');
    }

    /**
     * Scope: retorna apenas números ativos, vinculados e válidos
     */
    public function scopeAtivos($query)
    {
        return $query->where('ativo', true)
                     ->whereNotNull('numero')
                     ->whereNotNull('user_id');
    }

    /**
     * Scope: retorna apenas números premiados
     */
    public function scopePremiados($query)
    {
        return $query->where('premiado', true);
    }
}
