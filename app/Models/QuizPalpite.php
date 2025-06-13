<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizPalpite extends Model
{
    use HasFactory;

    protected $table = 'quiz_palpites';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'user_id',
        'match_id',
        'guess_score_home',
        'guess_score_away',
        'points',
    ];

    /**
     * Tipos dos campos
     */
    protected $casts = [
        'guess_score_home' => 'integer',
        'guess_score_away' => 'integer',
        'points' => 'integer',
    ];

    /**
     * Relacionamento com o usuário que fez o palpite
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com o jogo correspondente ao palpite
     */
    public function match()
    {
        return $this->belongsTo(QuizMatch::class, 'match_id');
    }

    /**
     * Retorna true se o palpite está exatamente correto
     */
    public function isCorreto()
    {
        return $this->guess_score_home === $this->match->score_home &&
               $this->guess_score_away === $this->match->score_away;
    }

    /**
     * Retorna true se o palpite acertou apenas o vencedor (ou empate)
     */
    public function acertouResultado()
    {
        return $this->match->resultadoPalpite($this) === $this->match->resultado()
            && !$this->isCorreto();
    }
}
