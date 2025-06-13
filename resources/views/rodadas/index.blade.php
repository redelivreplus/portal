@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Rodadas</h1>

    <a href="{{ route('rodadas.create') }}" class="btn btn-primary mb-3">Criar Nova Rodada</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th style="width: 20%;">Rodada</th>
                <th>Prêmio</th>
                <th style="width: 8%;">Jogos</th>
                <th style="width: 8%;">Status</th>
                <th style="width: 22%;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rodadas as $rodada)
                <tr class="text-center align-middle">
                    <td>{{ $rodada->titulo }}</td> {{-- << Aqui substituímos ID por TÍTULO --}}
                    <td>{{ $rodada->premio_rodada }}</td>
                    <td>{{ $rodada->quantidade_jogos }}</td>
                    <td>
                        @if($rodada->status)
    <span class="badge bg-danger">Encerrada</span>
@else
    <span class="badge bg-success text-white">Aberta</span>

@endif

                    </td>
                    <td class="d-flex justify-content-center gap-1 flex-wrap">
                        <a href="{{ route('rodadas.show', $rodada) }}" class="btn btn-info btn-sm">Ver</a>

                        @if(!$rodada->status)
                            <a href="{{ route('rodadas.edit', $rodada) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('rodadas.encerrar', $rodada) }}" method="POST" onsubmit="return confirm('Deseja encerrar esta rodada?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Encerrar</button>
                            </form>
                        @else
                            <a href="{{ route('rodadas.ranking', $rodada) }}" class="btn btn-dark btn-sm">Ranking</a>
                        @endif

                        <form action="{{ route('rodadas.destroy', $rodada) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta rodada?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhuma rodada cadastrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
