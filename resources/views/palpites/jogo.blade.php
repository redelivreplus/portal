@extends('layouts.app')

@section('title', $jogo->time1 . ' x ' . $jogo->time2)

@section('content')
<div class="container">

    {{-- Cabeçalho com os times --}}
    <div class="text-center my-4">
        <h2>
            <img src="{{ asset('escudos/' . $jogo->time1_escudo) }}" alt="{{ $jogo->time1 }}" width="50">
            {{ $jogo->time1 }}
            <span class="mx-2">x</span>
            {{ $jogo->time2 }}
            <img src="{{ asset('escudos/' . $jogo->time2_escudo) }}" alt="{{ $jogo->time2 }}" width="50">
        </h2>
    </div>

    {{-- Alerta de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Lista de palpites --}}
    @if($palpites->count())
        <h4 class="mb-3">Palpites enviados ({{ $palpites->count() }})</h4>
        
        @foreach($palpites as $palpite)
            <div class="card mb-3">
                <div class="card-body">
                    <strong>{{ $palpite->usuario_nome }}</strong> 
                    <small class="text-muted">
                        ({{ $palpite->cidade }} - {{ $palpite->estado }})
                        • {{ \Carbon\Carbon::parse($palpite->created_at)->format('d / m / Y \à\s H:i') }}
                    </small>
                    <div class="mt-2">
                        <img src="{{ asset('escudos/' . $jogo->time1_escudo) }}" alt="{{ $jogo->time1 }}" width="30">
                        <strong class="mx-1">{{ $palpite->placar_time1 }}</strong>
                        x
                        <strong class="mx-1">{{ $palpite->placar_time2 }}</strong>
                        <img src="{{ asset('escudos/' . $jogo->time2_escudo) }}" alt="{{ $jogo->time2 }}" width="30">
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Nenhum palpite enviado ainda para este jogo.</p>
    @endif

</div>
@endsection
