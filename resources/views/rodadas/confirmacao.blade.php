@extends('layouts.app')

@section('title', 'Confirmação de Palpites')

@section('content')
<div class="container">
    <h1 class="mb-4">Seus Palpites – Rodada #{{ $rodada->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($palpites as $jogo)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $jogo->time_a }} x {{ $jogo->time_b }}</h5>
                <p>
                    Palpite: 
                    <strong>
                        @php
                            $palpite = $jogo->palpites->first();
                        @endphp

                        @switch($palpite?->palpite)
                            @case('A') {{ $jogo->time_a }} @break
                            @case('B') {{ $jogo->time_b }} @break
                            @case('E') Empate @break
                            @default Nenhum palpite
                        @endswitch
                    </strong>
                </p>
            </div>
        </div>
    @empty
        <p>Você ainda não registrou palpites para esta rodada.</p>
    @endforelse

    <a href="{{ route('palpites.index') }}" class="btn btn-secondary mt-3">Voltar para os Palpites</a>
</div>
@endsection
