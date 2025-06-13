<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'username',
        'profile_slug',
        'profile_image_url',
        'birth_date',
        'address',
        'neighborhood',
        'fk_city_id',
        'state',
        'phone',
        'whatsapp',
        'email',
        'password',
        'password_reset_token',
        'remember_token',
        'user_category',
        'fk_affiliate_tier_id',
        'status',
        'last_login_at',
        'bio',
        'interests',
        'facebook_profile_url',
        'instagram_profile_url',
        'twitter_profile_url',
        'youtube_profile_url',
        'football_wins_count',
        'raffle_participations_count',
        'show_bio',
        'show_interests',
        'user_title', // campo para armazenar título/apelido
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'show_bio' => 'boolean',
            'show_interests' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'fk_city_id');
    }

    public function affiliateTier(): BelongsTo
    {
        return $this->belongsTo(AffiliateTier::class, 'fk_affiliate_tier_id');
    }

    public function palpites(): HasMany
    {
        return $this->hasMany(QuizPalpite::class, 'user_id');
    }

    // Verifica se o usuário já palpitou em um jogo específico
    public function jaPalpitou(int $matchId): bool
    {
        return $this->palpites()->where('match_id', $matchId)->exists();
    }

    // Total de acertos exatos (3 pontos)
    public function totalAcertosExatos(): int
    {
        return $this->palpites()->where('points', 3)->count();
    }

    // Total de acertos por resultado (2 pontos)
    public function totalAcertosResultado(): int
    {
        return $this->palpites()->where('points', 2)->count();
    }

    // Total de palpites feitos
    public function totalPalpites(): int
    {
        return $this->palpites()->count();
    }

    /**
     * Retorna o título/apelido do usuário conforme sua pontuação.
     *
     * Possíveis títulos:
     * - 'rei' => Acerto exato do placar (3 pontos)
     * - 'bom_de_palpite' => Acerto do vencedor ou empate (2 pontos)
     * - 'iniciante' => Palpite errado (0 pontos)
     * - 'novato' => Sem palpites
     */
    public function calcularTitulo(): string
    {
        $totalPalpites = $this->totalPalpites();

        if ($totalPalpites === 0) {
            return 'novato';
        }

        if ($this->totalAcertosExatos() > 0) {
            return 'rei';
        }

        if ($this->totalAcertosResultado() > 0) {
            return 'bom_de_palpite';
        }

        return 'iniciante';
    }

    /**
     * Retorna um array com os dados do troféu do usuário para exibição.
     */
    public function trophy(): array
    {
        $titulo = $this->calcularTitulo();

        switch ($titulo) {
            case 'rei':
                return [
                    'icon' => '🏆',
                    'count' => $this->totalAcertosExatos(),
                    'title' => 'Rei do Palpite',
                    'icon_size' => '2rem',
                ];
            case 'bom_de_palpite':
                return [
                    'icon' => '🎯',
                    'count' => $this->totalAcertosResultado(),
                    'title' => 'Bom de palpite',
                    'icon_size' => '1.5rem',
                ];
            case 'iniciante':
                $inicianteCount = $this->totalPalpites() - $this->totalAcertosExatos() - $this->totalAcertosResultado();
                return [
                    'icon' => '😬',
                    'count' => max(0, $inicianteCount),
                    'title' => 'Pé Frio',
                    'icon_size' => '1.5rem',
                ];
            case 'novato':
            default:
                return [
                    'icon' => '😶',
                    'count' => 0,
                    'title' => 'Nenhum Palpite',
                    'icon_size' => '1.5rem',
                ];
        }
    }

    // Relacionamento: usuários que este usuário segue
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'follower_id',
            'followed_id'
        )->withTimestamps();
    }

    // Relacionamento: usuários que seguem este usuário
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'followed_id',
            'follower_id'
        )->withTimestamps();
    }
	
	
	// Relacionamento com palpites de rodadas (novo sistema)
public function palpitesRodada(): \Illuminate\Database\Eloquent\Relations\HasMany
{
    return $this->hasMany(\App\Models\Palpite::class, 'user_id');
}

	
	
	
	
	
	
	
}
