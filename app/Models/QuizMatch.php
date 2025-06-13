<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuizMatch extends Model
{
    use HasFactory;

    protected $table = 'quiz_matches';

    protected $fillable = [
        'team_home',
        'team_away',
        'match_date',
        'match_time',
        'escudo_home',
        'escudo_away',
        'score_home',
        'score_away',
        'placar_home',
        'placar_away',
        'slug',
    ];

    protected $casts = [
        'match_date' => 'date',
        'match_time' => 'string',
        'score_home' => 'integer',
        'score_away' => 'integer',
        'placar_home' => 'integer',
        'placar_away' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::creating(function ($match) {
            $slugBase = Str::slug("{$match->team_home}-x-{$match->team_away}-{$match->match_date}", '-');
            $originalSlug = $slugBase;
            $count = 1;
            while (static::where('slug', $slugBase)->exists()) {
                $slugBase = $originalSlug . '-' . $count++;
            }
            $match->slug = $slugBase;
        });
    }

    public function palpites()
    {
        return $this->hasMany(QuizPalpite::class, 'match_id');
    }

    /**
     * Calcula os pontos dos palpites após o jogo.
     * Atualiza em lote para melhor performance.
     */
    public function calcularPontos()
    {
        $palpites = $this->palpites()->get();

        if ($palpites->isEmpty()) {
            return;
        }

        $updates = [];

        foreach ($palpites as $palpite) {
            $points = 0;

            if (
                (int) $palpite->guess_score_home === (int) $this->score_home &&
                (int) $palpite->guess_score_away === (int) $this->score_away
            ) {
                $points = 3;
            } else {
                if ($this->resultado() === $this->resultadoPalpite($palpite)) {
                    $points = 1;
                }
            }

            $updates[$palpite->id] = $points;
        }

        if (empty($updates)) {
            return;
        }

        $cases = '';
        $ids = [];

        foreach ($updates as $id => $points) {
            $cases .= "WHEN {$id} THEN {$points} ";
            $ids[] = $id;
        }

        $idsList = implode(',', $ids);

        $query = "UPDATE quiz_palpites SET points = CASE id {$cases} END WHERE id IN ({$idsList})";

        DB::statement($query);

        /*
        // Método antigo e menos performático (um update por palpite)
        foreach ($palpites as $palpite) {
            $palpite->points = $updates[$palpite->id];
            $palpite->save();
        }
        */
    }

    public function resultado()
    {
        if ($this->score_home > $this->score_away) {
            return 'home';
        } elseif ($this->score_away > $this->score_home) {
            return 'away';
        }
        return 'draw';
    }

    public function resultadoPalpite(QuizPalpite $palpite)
    {
        if ($palpite->guess_score_home > $palpite->guess_score_away) {
            return 'home';
        } elseif ($palpite->guess_score_away > $palpite->guess_score_home) {
            return 'away';
        }
        return 'draw';
    }

    public function jaComecou()
    {
        $matchDateTime = Carbon::parse($this->match_date->format('Y-m-d') . ' ' . $this->match_time);
        return Carbon::now()->greaterThanOrEqualTo($matchDateTime);
    }
}
