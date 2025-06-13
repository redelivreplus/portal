@extends('layouts.app')

@section('content')
<style>
    .custom-header {
        background-color: #156DAF;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .custom-body {
        background-color: #e9e9e9;
        padding: 2rem 1.5rem;
        border-radius: 0 0 0.375rem 0.375rem;
    }

    .premio-destaque {
        font-size: 1.5rem;
        font-weight: bold;
        color: #156DAF;
        margin-bottom: 1.5rem;
    }

    .jogo-card {
        font-size: 1.1rem;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #f5f5f5;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    .radio-box {
        width: 13%;
        padding: 0.4rem;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2.5rem;
    }

    .radio-box input[type="radio"] {
        transform: scale(1.7);
        accent-color: #156DAF;
    }
</style>

<div class="container px-0">
    <div class="custom-header">
        <h1 class="mb-0">Rodada #{{ $rodada->id }}</h1>
    </div>

    <div class="custom-body">
        <p class="premio-destaque">🏆 Prêmio: {{ $rodada->premio_rodada }}</p>

        <p><strong>Quantidade de Jogos:</strong> {{ $rodada->quantidade_jogos }}</p>
        <p><strong>Status:</strong>
            @if($rodada->status)
                <span class="badge bg-danger">Encerrada</span>
            @else
                <span class="badge bg-success">Aberta</span>
            @endif
        </p>

        <hr>

        <h3 class="mt-4">Jogos da Rodada</h3>

        @if($rodada->jogos->isEmpty())
            <div class="alert alert-info mt-3">Nenhum jogo cadastrado para essa rodada.</div>
        @else
            @foreach($rodada->jogos as $jogo)
                <div class="d-flex justify-content-between align-items-center jogo-card">
                    <!-- Time A -->
                    <strong style="width: 30%; text-align: right; padding: 0.4rem;">
                        {{ $jogo->time_a }}
                    </strong>

                    <!-- Botões -->
                    <div class="radio-box">
                        <label>
                            <input type="radio" name="resultados[{{ $jogo->id }}]" value="time_a"
                                {{ $jogo->resultado_oficial === 'time_a' ? 'checked' : 'disabled' }}>
                        </label>
                        <label>
                            <input type="radio" name="resultados[{{ $jogo->id }}]" value="empate"
                                {{ $jogo->resultado_oficial === 'empate' ? 'checked' : 'disabled' }}>
                        </label>
                        <label>
                            <input type="radio" name="resultados[{{ $jogo->id }}]" value="time_b"
                                {{ $jogo->resultado_oficial === 'time_b' ? 'checked' : 'disabled' }}>
                        </label>
                    </div>

                    <!-- Time B -->
                    <strong style="width: 30%; text-align: left; padding: 0.4rem;">
                        {{ $jogo->time_b }}
                    </strong>

                    <!-- Acertos -->
                    <div style="width: 30%; padding: 0.4rem 0.6rem;">
                        <span class="small text-muted" style="display: flex; gap: 2rem;">
                            <span>🎯 {{ $jogo->acertos_3 ?? 0 }}</span>
                            <span>✅ {{ $jogo->acertos_1 ?? 0 }}</span>
                            <span>❌ {{ $jogo->acertos_0 ?? 0 }}</span>
                        </span>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('rodadas.index') }}" class="btn btn-secondary">Voltar</a>

            @if($rodada->status)
                <a href="{{ route('rodadas.ranking', $rodada) }}" class="btn btn-primary">Ver Ranking</a>
            @endif
        </div>
    </div>
</div>
@endsection
