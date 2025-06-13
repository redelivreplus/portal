<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $fillable = [
        'rodada_id',
        'time_a',
        'time_b',
        'resultado_oficial',
    ];

    public function rodada()
    {
        return $this->belongsTo(Rodada::class);
    }

    public function palpites()
    {
        return $this->hasMany(Palpite::class);
    }

    /**
     * Atualiza automaticamente os pontos dos palpites
     * quando o resultado oficial for definido ou alterado.
     */
    protected static function booted()
    {
        static::saved(function ($jogo) {
            if ($jogo->wasChanged('resultado_oficial') && $jogo->resultado_oficial) {
                foreach ($jogo->palpites as $palpite) {
                    $acertou = $palpite->palpite === $jogo->resultado_oficial;

                    $palpite->acerto_exato = $acertou ? 1 : 0;
                    $palpite->acerto_resultado = $acertou ? 1 : 0;
                    $palpite->pontos = $acertou ? 3 : 0;

                    $palpite->save();
                }
            }
        });
    }
}
