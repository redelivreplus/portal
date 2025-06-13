@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
        Ranking da Rodada #{{ $rodada->id }} - <small class="text-muted">{{ $rodada->premio_rodada }}</small>
    </h1>

    @if($ranking->isEmpty())
        <div class="alert alert-info">
            Nenhum palpite registrado para essa rodada.
        </div>
    @else
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Posição</th>
                    <th>Usuário</th>
                    <th>Pontos</th>
                    <th>Acertos Exatos</th>
                    <th>Acertos por Resultado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $index => $item)
                    <tr @class([
                        'table-success' => $index === 0,
                        'fw-bold' => $index < 3,
                    ])>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->total_points }}</td>
                        <td>{{ $item->exact_hits }}</td>
                        <td>{{ $item->result_hits }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('rodadas.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
