@extends('layouts.pag')

@section('content')
<div class="container mt-5">
    <div class="card border-secondary bg-secondary bg-opacity-10 p-4">
        <h3 class="text-center mb-4">Confirmação do seu palpite</h3>

        <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap text-center">

            {{-- BLOCO TIME HOME --}}
            <div class="d-flex align-items-center gap-2">
                @if ($palpite['escudo_home'])
                    <img src="{{ asset('storage/' . $palpite['escudo_home']) }}" alt="{{ $palpite['team_home'] }}" style="height: 40px;">
                @endif
                <div class="text-start">
                    <div class="fw-bold">{{ $palpite['team_home'] }}</div>
                </div>
                <div class="fw-bold fs-4 ms-1">{{ $palpite['palpite_home'] }}</div>
            </div>

            {{-- X sem margem horizontal --}}
            <div class="fw-bold fs-4 mx-0">x</div>

            {{-- BLOCO TIME AWAY --}}
            <div class="d-flex align-items-center gap-2">
                <div class="fw-bold fs-4 me-1">{{ $palpite['palpite_away'] }}</div>
                <div class="text-end">
                    <div class="fw-bold">{{ $palpite['team_away'] }}</div>
                </div>
                @if ($palpite['escudo_away'])
                    <img src="{{ asset('storage/' . $palpite['escudo_away']) }}" alt="{{ $palpite['team_away'] }}" style="height: 40px;">
                @endif
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('quiz.palpite') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
