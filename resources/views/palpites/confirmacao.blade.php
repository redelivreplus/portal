@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Mensagem de sucesso --}}
    <div class="alert alert-success text-center">
        <h4 class="fw-bold">✅ Palpite enviado com sucesso!</h4>
    </div>

    {{-- Palpite do usuário --}}
    <div class="card shadow-sm mx-auto mb-4" style="max-width: 600px;">
        <div class="card-body text-center">
            <h5 class="text-primary mb-3">Jogo:</h5>

            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <img src="{{ asset('storage/' . $match->escudo_home) }}" width="40">
                <strong>{{ strtoupper($match->team_home) }}</strong>
                <span class="mx-2">x</span>
                <strong>{{ strtoupper($match->team_away) }}</strong>
                <img src="{{ asset('storage/' . $match->escudo_away) }}" width="40">
            </div>

            <p class="fw-bold mb-4">
                Seu palpite: {{ $palpite->guess_score_home }} x {{ $palpite->guess_score_away }}
            </p>

            <hr>

            <p class="text-muted small">
                Enviado por: <strong>{{ $user->name }}</strong><br>
                Cidade/UF: <strong>{{ optional($user->city)->name ?? 'N/A' }}/{{ $user->state ?? 'N/A' }}</strong><br>
                Enviado em: {{ $palpite->created_at->format('d/m/Y H:i') }}
            </p>

            <a href="{{ route('palpites.index') }}" class="btn btn-outline-primary mt-3">Voltar aos palpites</a>
        </div>
    </div>

    {{-- Outros palpites do mesmo jogo --}}
    @if ($outrosPalpites->count())
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-header text-center bg-light fw-bold">
                Outros Palpites para este jogo
            </div>
            <div class="card-body">
                @foreach ($outrosPalpites as $p)
                    <div class="palpite card mb-3 p-3 shadow-sm">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="text-primary fw-bold me-2">
                                {{ $p->user->name ?? 'Usuário' }} •
                                {{ optional($p->user->city)->name ?? 'Cidade' }} - {{ $p->user->state ?? 'UF' }} •
                                {{ $p->created_at->format('d / m / Y \à\s H:i') }}
                            </div>

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="fw-bold">{{ $match->team_home }}</span>
                                <img src="{{ asset('storage/' . $match->escudo_home) }}" width="28">
                                <span class="fw-bold fs-5">{{ $p->guess_score_home }}</span>
                                <span class="text-muted">x</span>
                                <span class="fw-bold fs-5">{{ $p->guess_score_away }}</span>
                                <img src="{{ asset('storage/' . $match->escudo_away) }}" width="28">
                                <span class="fw-bold">{{ $match->team_away }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .palpite {
        background: #fff;
        border-radius: 6px;
        font-size: 16px;
    }
</style>
@endpush
