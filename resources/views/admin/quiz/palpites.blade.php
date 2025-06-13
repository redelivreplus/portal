@extends('layouts.pag')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($proximoJogo)
        <div class="card border-secondary bg-secondary bg-opacity-10 mb-4">
            <div class="card-body text-dark">
                <h3 class="text-center text-dark mb-4">Próximo jogo:</h3>
                <h4 class="text-center text-dark mb-4">
                    {{ $proximoJogo->team_home }} x {{ $proximoJogo->team_away }} - 
                    {{ $proximoJogo->match_date->format('d/m/Y') }} {{ $proximoJogo->match_time }}
                </h4>

                <form method="POST" action="{{ route('palpites.store', $proximoJogo->id) }}">
                    @csrf

                    <div class="row justify-content-center align-items-center mb-4 text-center">
                        <div class="col-auto d-flex align-items-center gap-2">
                            @if($proximoJogo->escudo_home)
                                <img src="{{ asset('storage/' . $proximoJogo->escudo_home) }}" alt="{{ $proximoJogo->team_home }}" style="height: 40px;">
                            @endif
                            <strong>{{ $proximoJogo->team_home }}</strong>
                        </div>

                        <div class="col-md-1">
                            <input type="number" min="0" name="palpite_home" id="palpite_home"
                                class="form-control text-center @error('palpite_home') is-invalid @enderror"
                                required value="{{ old('palpite_home') }}">
                            @error('palpite_home')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <strong>X</strong>
                        </div>

                        <div class="col-md-1">
                            <input type="number" min="0" name="palpite_away" id="palpite_away"
                                class="form-control text-center @error('palpite_away') is-invalid @enderror"
                                required value="{{ old('palpite_away') }}">
                            @error('palpite_away')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-auto d-flex align-items-center gap-2">
                            <strong>{{ $proximoJogo->team_away }}</strong>
                            @if($proximoJogo->escudo_away)
                                <img src="{{ asset('storage/' . $proximoJogo->escudo_away) }}" alt="{{ $proximoJogo->team_away }}" style="height: 40px;">
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary px-4">Enviar Palpite</button>
                    </div>
                </form>
            </div>
        </div>
   @else
    <div class="alert bg-light text-dark fw-bold fs-5 border text-center">
        Não há jogos disponíveis para palpites no momento.
    </div>
@endif

    <hr>

    @if($ultimoJogo)
        <div class="card border-danger bg-danger bg-opacity-10 mb-4">
            <div class="card-body text-center text-dark">
                <h4>Último jogo encerrado:</h4>
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mt-3">
                    @if($ultimoJogo->escudo_home)
                        <img src="{{ asset('storage/' . $ultimoJogo->escudo_home) }}" alt="{{ $ultimoJogo->team_home }}" style="height: 40px;">
                    @endif
                    <strong>{{ $ultimoJogo->team_home }}</strong>
                    <strong>{{ $ultimoJogo->score_home }} x {{ $ultimoJogo->score_away }}</strong>
                    <strong>{{ $ultimoJogo->team_away }}</strong>
                    @if($ultimoJogo->escudo_away)
                        <img src="{{ asset('storage/' . $ultimoJogo->escudo_away) }}" alt="{{ $ultimoJogo->team_away }}" style="height: 40px;">
                    @endif
                </div>
                <div class="mt-2">
                    <small class="text-muted">{{ $ultimoJogo->match_date->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
    @else
        <p>Sem jogos encerrados ainda.</p>
    @endif

    <hr>

   <h4 class="text-center">Jogos encerrados:</h4>
    @if($jogos->count() > 0)
        @php
            $graySteps = ['#f5f5f5', '#ffffff'];
        @endphp
        @foreach($jogos as $index => $jogo)
            @php $bgColor = $graySteps[$index % count($graySteps)]; @endphp
            <div class="card mb-3" style="background-color: {{ $bgColor }};">
                <div class="card-body text-dark text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                        @if($jogo->escudo_home)
                            <img src="{{ asset('storage/' . $jogo->escudo_home) }}" alt="{{ $jogo->team_home }}" style="height: 30px;">
                        @endif
                        <strong>{{ $jogo->team_home }}</strong>
                        <strong>{{ $jogo->score_home }} x {{ $jogo->score_away }}</strong>
                        <strong>{{ $jogo->team_away }}</strong>
                        @if($jogo->escudo_away)
                            <img src="{{ asset('storage/' . $jogo->escudo_away) }}" alt="{{ $jogo->team_away }}" style="height: 30px;">
                        @endif
                    </div>
                    <div class="mt-1">
                        <small class="text-muted">{{ $jogo->match_date->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Sem jogos encerrados adicionais.</p>
    @endif

</div>
@endsection
