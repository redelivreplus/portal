@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Editar Resultado da Rodada</h5>
                    </div>

                    <div class="card-body" style="background-color: #e9e9e9;">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @elseif (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('rodadas.finalizar', $rodada) }}" method="POST">
                            @csrf

                            <!-- Campos somente leitura -->
                            <div class="mb-3">
                                <label class="form-label">Título da Rodada</label>
                                <input type="text" class="form-control" value="{{ $rodada->titulo }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prêmio</label>
                                <input type="text" class="form-control" value="{{ $rodada->premio_rodada }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de Jogos</label>
                                <input type="number" class="form-control" value="{{ $rodada->quantidade_jogos }}" readonly>
                            </div>

                            <hr>

                            <!-- Resultados dos Jogos -->
                            <h5 class="mb-3">Resultados dos Jogos</h5>

                            @foreach ($rodada->jogos as $index => $jogo)
                                <div class="d-flex justify-content-between align-items-center p-2 my-2"
                                    style="font-size: 1.1rem; border: 1px solid #dee2e6; border-radius: 5px; background-color: #f5f5f5;">

                                    <!-- Time A -->
                                    <strong style="width: 40%;  text-align: right;">
                                        {{ $jogo->time_a }}
                                    </strong>

                                    <!-- Botões -->
                                  <div class="d-flex justify-content-center gap-5" style="width: 20%; padding: 0.1rem; border-radius: 6px;">
    <label>
        <input type="radio" name="resultados[{{ $jogo->id }}]" value="time_a"
            {{ $jogo->resultado_oficial === 'time_a' ? 'checked' : '' }}
            style="transform: scale(1.6); accent-color: #156DAF;">
    </label>
    <label>
        <input type="radio" name="resultados[{{ $jogo->id }}]" value="empate"
            {{ $jogo->resultado_oficial === 'empate' ? 'checked' : '' }}
            style="transform: scale(1.6); accent-color: #156DAF;">
    </label>
    <label>
        <input type="radio" name="resultados[{{ $jogo->id }}]" value="time_b"
            {{ $jogo->resultado_oficial === 'time_b' ? 'checked' : '' }}
            style="transform: scale(1.6); accent-color: #156DAF;">
    </label>
</div>


                                    <!-- Time B -->
                                    <strong style="width: 40%; border:  text-align: left;">
                                        {{ $jogo->time_b }}
                                    </strong>
                                </div>
                            @endforeach

                            <hr>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('rodadas.index') }}" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Salvar Resultados</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
