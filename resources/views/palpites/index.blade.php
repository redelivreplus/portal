@extends('layouts.app')

@section('content')

<div class="container py-4">
    <h2 class="text-center text-primary fw-bold mb-4">📊 Palpites - Lista de Jogos</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Mostrar erros do formulário --}}
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- JOGO DISPONÍVEL PARA PALPITE --}}
    @if($jogoDestaque)
        <div class="alert alert-info shadow-sm p-4 text-center">
            <h5 class="fw-bold mb-4">✅ Jogo disponível para palpite</h5>

            <form method="POST" action="{{ route('palpites.store') }}" class="mt-3">
                @csrf
                <input type="hidden" name="match_id" value="{{ $jogoDestaque->id }}">

                <div class="d-flex align-items-center justify-content-center gap-2">
                    <img src="{{ asset('storage/' . $jogoDestaque->escudo_home) }}" width="40" class="me-2">
                    <strong class="me-2">{{ strtoupper($jogoDestaque->team_home) }}</strong>
                    <input type="number" name="guess_score_home" class="form-control" style="width: 60px;" required min="0" value="{{ old('guess_score_home') }}">
                    <span class="mx-2 fw-bold">x</span>
                    <input type="number" name="guess_score_away" class="form-control" style="width: 60px;" required min="0" value="{{ old('guess_score_away') }}">
                    <strong class="ms-2">{{ strtoupper($jogoDestaque->team_away) }}</strong>
                    <img src="{{ asset('storage/' . $jogoDestaque->escudo_away) }}" width="40" class="ms-2">
                </div>

                <div class="text-center mt-2 text-muted">
                    {{ \Carbon\Carbon::parse($jogoDestaque->match_date)->format('d/m/Y') }} 
                    às {{ \Carbon\Carbon::parse($jogoDestaque->match_time)->format('H:i') }}
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-success">Enviar Palpite</button>
                </div>
            </form>
        </div>
    @else
        <div class="alert alert-warning text-center">⚠️ Aguarde o próximo jogo.</div>
    @endif

    {{-- ÚLTIMO JOGO ENCERRADO --}}
    @if($ultimoEncerrado)
        <div class="alert alert-primary shadow-sm mt-4">
            <h5 class="fw-bold">🏁 Último jogo encerrado</h5>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $ultimoEncerrado->escudo_home) }}" width="40" class="me-2">
                    <strong>{{ strtoupper($ultimoEncerrado->team_home) }}</strong>
                    <span class="mx-2">{{ $ultimoEncerrado->score_home }} x {{ $ultimoEncerrado->score_away }}</span>
                    <strong>{{ strtoupper($ultimoEncerrado->team_away) }}</strong>
                    <img src="{{ asset('storage/' . $ultimoEncerrado->escudo_away) }}" width="40" class="ms-2">
                </div>
                <div class="text-end d-flex align-items-center gap-2">
                    <div class="text-start">
                        {{ \Carbon\Carbon::parse($ultimoEncerrado->match_date)->format('d/m/Y') }}
                        às {{ \Carbon\Carbon::parse($ultimoEncerrado->match_time)->format('H:i') }}
                    </div>
                    <a href="{{ route('quiz.resultado', $ultimoEncerrado->slug) }}" class="btn btn-primary btn-sm">Exibir Resultado</a>
                </div>
            </div>
        </div>
    @endif

    {{-- JOGOS ENCERRADOS --}}
    @if($jogosEncerrados->count())
        <div class="mt-4">
            <h5 class="text-secondary">📚 Jogos encerrados</h5>
            <ul class="list-group">
                @foreach($jogosEncerrados as $jogo)
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-md-3 d-flex justify-content-end align-items-center">
                                <div style="width: 160px;" class="text-end pe-2">
                                    <strong>{{ strtoupper($jogo->team_home) }}</strong>
                                </div>
                                <img src="{{ asset('storage/' . $jogo->escudo_home) }}" width="30">
                            </div>
                            <div class="col-md-1 text-center fw-bold">
                                {{ $jogo->score_home }} x {{ $jogo->score_away }}
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <img src="{{ asset('storage/' . $jogo->escudo_away) }}" width="30" class="me-2">
                                <strong>{{ strtoupper($jogo->team_away) }}</strong>
                            </div>
                            <div class="col-md-2 d-flex justify-content-between align-items-center text-muted small">
                                <div class="text-start">
                                    {{ \Carbon\Carbon::parse($jogo->match_date)->format('d/m/Y') }}
                                    às {{ \Carbon\Carbon::parse($jogo->match_time)->format('H:i') }}
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <a href="{{ route('quiz.resultado', $jogo->slug) }}" class="btn btn-primary btn-sm">Exibir Resultado</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
