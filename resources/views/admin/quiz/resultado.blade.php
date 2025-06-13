@extends('layouts.pag')

@section('content')
<div class="container mt-4">

    <h2 class="text-center mb-4">Resultado do jogo: {{ $jogo->team_home }} x {{ $jogo->team_away }}</h2>

    <div class="text-center mb-4 fs-4">
        <img src="{{ asset('storage/' . $jogo->escudo_home) }}" alt="{{ $jogo->team_home }}" style="height: 40px;">
        <strong>{{ $jogo->score_home }} x {{ $jogo->score_away }}</strong>
        <img src="{{ asset('storage/' . $jogo->escudo_away) }}" alt="{{ $jogo->team_away }}" style="height: 40px;">
    </div>

    <div class="row mb-4">
        <div class="col-md-4 border rounded p-3">
            <h5 class="text-center mb-3">3 pontos - Acertou placar exato</h5>
            @forelse($palpites3pts as $palpite)
                <p>{{ $palpite->user->name }} ({{ $palpite->user->city->name ?? 'Cidade' }} - {{ $palpite->user->state ?? '' }})</p>
                <p class="text-center">
                    <img src="{{ asset('storage/' . $jogo->escudo_home) }}" alt="{{ $jogo->team_home }}" style="height: 20px;">
                    {{ $palpite->guess_score_home }} x {{ $palpite->guess_score_away }}
                    <img src="{{ asset('storage/' . $jogo->escudo_away) }}" alt="{{ $jogo->team_away }}" style="height: 20px;">
                </p>
                <hr>
            @empty
                <p class="text-center">Ninguém acertou o placar exato.</p>
            @endforelse
        </div>

        <div class="col-md-4 border rounded p-3">
            <h5 class="text-center mb-3">1 ponto - Acertou vencedor ou empate</h5>
            @forelse($palpites1pt as $palpite)
                <p>{{ $palpite->user->name }} ({{ $palpite->user->city->name ?? 'Cidade' }} - {{ $palpite->user->state ?? '' }})</p>
                <p class="text-center">
                    <img src="{{ asset('storage/' . $jogo->escudo_home) }}" alt="{{ $jogo->team_home }}" style="height: 20px;">
                    {{ $palpite->guess_score_home }} x {{ $palpite->guess_score_away }}
                    <img src="{{ asset('storage/' . $jogo->escudo_away) }}" alt="{{ $jogo->team_away }}" style="height: 20px;">
                </p>
                <hr>
            @empty
                <p class="text-center">Ninguém acertou o vencedor/empate.</p>
            @endforelse
        </div>

        <div class="col-md-4 border rounded p-3">
            <h5 class="text-center mb-3">0 ponto - Errou o resultado</h5>
            @forelse($palpites0pt as $palpite)
                <p>{{ $palpite->user->name }} ({{ $palpite->user->city->name ?? 'Cidade' }} - {{ $palpite->user->state ?? '' }})</p>
                <p class="text-center">
                    <img src="{{ asset('storage/' . $jogo->escudo_home) }}" alt="{{ $jogo->team_home }}" style="height: 20px;">
                    {{ $palpite->guess_score_home }} x {{ $palpite->guess_score_away }}
                    <img src="{{ asset('storage/' . $jogo->escudo_away) }}" alt="{{ $jogo->team_away }}" style="height: 20px;">
                </p>
                <hr>
            @empty
                <p class="text-center">Sem palpites nesta categoria.</p>
            @endforelse
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('quiz.palpite') }}" class="btn btn-secondary">Voltar aos Palpites</a>
    </div>
</div>
@endsection
