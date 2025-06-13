@extends('layouts.app')

@section('content')
<style>
    /* Tons de cinza customizados para o card-header */
    .bg-gray-dark {
        background-color: #343a40 !important; /* cinza escuro */
        color: white !important;
    }
    .bg-gray-medium {
        background-color: #6c757d !important; /* cinza médio (equivale ao secondary) */
        color: white !important;
    }
    .bg-gray-light {
        background-color: #d6d8db !important; /* cinza claro */
        color: #212529 !important; /* texto escuro para contraste */
    }
</style>

<div class="container mt-5">

    {{-- Card com o resultado final do jogo --}}
    <div class="card mb-5" style="border: 2px solid #6c757d; background-color: #e9e9e9;">
        <div class="card-body text-center">
            <h2 class="mb-4">Final de Jogo</h2>

            <h4>
                {{ $match->team_home }}
                @if ($match->escudo_home)
                    <img src="{{ asset('storage/' . $match->escudo_home) }}" alt="{{ $match->team_home }}" style="height: 30px;">
                @endif
                {{ $match->score_home }} x {{ $match->score_away }}
                @if ($match->escudo_away)
                    <img src="{{ asset('storage/' . $match->escudo_away) }}" alt="{{ $match->team_away }}" style="height: 30px;">
                @endif
                {{ $match->team_away }}
            </h4>
            <p class="text-muted">{{ $match->match_date->format('d/m/Y') }} às {{ $match->match_time }}</p>
        </div>
    </div>

    {{-- Palpites organizados em colunas --}}
    <div class="row">

        {{-- 3 Pontos - Rei do Palpite (cinza escuro) --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 2px solid #6c757d; background-color: #e9e9e9;">
                <div class="card-header bg-gray-dark">
                    <span class="me-2 fs-4">🏆</span>
                    Rei do Palpite (3 pontos)
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($pontuacao3 as $palpite)
                        <li class="list-group-item">
                            <strong>
                                <a href="{{ route('perfil.show', $palpite->user->profile_slug) }}">
                                    {{ $palpite->user->name }}
                                </a>
                            </strong>
                            <small class="text-muted d-block">
                                ({{ optional($palpite->user->city)->name ?? 'Cidade' }} - {{ $palpite->user->state ?? 'UF' }}) •
                                {{ $palpite->created_at->format('d/m/Y H:i') }}
                            </small>
                            <div class="mt-1">
                                <strong>{{ $match->team_home }}</strong> {{ $palpite->guess_score_home }}
                                x {{ $palpite->guess_score_away }} <strong>{{ $match->team_away }}</strong>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">Nenhum palpite com 3 pontos.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- 1 Ponto - Acertou o vencedor/empate (cinza médio) --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 2px solid #6c757d; background-color: #e9e9e9;">
                <div class="card-header bg-gray-medium">
                    <span class="me-2 fs-4">🎯</span>
                    Acertou o vencedor/empate (1 ponto)
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($pontuacao1 as $palpite)
                        <li class="list-group-item">
                            <strong>
                                <a href="{{ route('perfil.show', $palpite->user->profile_slug) }}">
                                    {{ $palpite->user->name }}
                                </a>
                            </strong>
                            <small class="text-muted d-block">
                                ({{ optional($palpite->user->city)->name ?? 'Cidade' }} - {{ $palpite->user->state ?? 'UF' }}) •
                                {{ $palpite->created_at->format('d/m/Y H:i') }}
                            </small>
                            <div class="mt-1">
                                <strong>{{ $match->team_home }}</strong> {{ $palpite->guess_score_home }}
                                x {{ $palpite->guess_score_away }} <strong>{{ $match->team_away }}</strong>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">Nenhum palpite com 1 ponto.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- 0 Ponto - Errou tudo (cinza claro) --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 2px solid #6c757d; background-color: #e9e9e9;">
                <div class="card-header bg-gray-light">
                    <span class="me-2 fs-4">😬</span>
                    Errou tudo (0 ponto)
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($pontuacao0 as $palpite)
                        <li class="list-group-item">
                            <strong>
                                <a href="{{ route('perfil.show', $palpite->user->profile_slug) }}">
                                    {{ $palpite->user->name }}
                                </a>
                            </strong>
                            <small class="text-muted d-block">
                                ({{ optional($palpite->user->city)->name ?? 'Cidade' }} - {{ $palpite->user->state ?? 'UF' }}) •
                                {{ $palpite->created_at->format('d/m/Y H:i') }}
                            </small>
                            <div class="mt-1">
                                <strong>{{ $match->team_home }}</strong> {{ $palpite->guess_score_home }}
                                x {{ $palpite->guess_score_away }} <strong>{{ $match->team_away }}</strong>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">Nenhum palpite com 0 ponto.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

    {{-- Botão Voltar --}}
    <div class="text-center mt-4">
        <a href="{{ route('palpites.index') }}" class="btn btn-secondary">Voltar aos Palpites</a>
    </div>

</div>
@endsection
