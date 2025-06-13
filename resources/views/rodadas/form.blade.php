@php
    $isEdit = isset($rodada);
    $action = $isEdit ? route('rodadas.update', $rodada) : route('rodadas.store');
    $method = $isEdit ? 'PUT' : 'POST';
    $disabled = $isEdit && $rodada->status ? 'disabled' : '';
@endphp

{{-- Exibe erros de validação --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erros no formulário:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    {{-- Título da Rodada --}}
    <div class="mb-3">
        <label for="titulo" class="form-label">Título da Rodada</label>
        <input 
            type="text" 
            name="titulo" 
            id="titulo" 
            class="form-control @error('titulo') is-invalid @enderror" 
            value="{{ old('titulo', $rodada->titulo ?? '') }}" 
            required 
            {{ $disabled }}
        >
        @error('titulo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Prêmio da Rodada --}}
    <div class="mb-3">
        <label for="premio_rodada" class="form-label">Prêmio da Rodada</label>
        <input 
            type="text" 
            name="premio_rodada" 
            id="premio_rodada" 
            class="form-control @error('premio_rodada') is-invalid @enderror" 
            value="{{ old('premio_rodada', $rodada->premio_rodada ?? '') }}" 
            required 
            {{ $disabled }}
        >
        @error('premio_rodada')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Quantidade de Jogos --}}
    <div class="mb-3">
        <label for="quantidade_jogos" class="form-label">Quantidade de Jogos</label>
        <input 
            type="number" 
            name="quantidade_jogos" 
            id="quantidade_jogos" 
            class="form-control @error('quantidade_jogos') is-invalid @enderror" 
            value="{{ old('quantidade_jogos', $rodada->quantidade_jogos ?? 10) }}" 
            min="1" 
            max="25" 
            required 
            {{ $disabled }}
        >
        @error('quantidade_jogos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Botões --}}
    @if(!$isEdit || !$rodada->status)
        <button type="submit" class="btn btn-primary">Salvar</button>
    @else
        <div class="alert alert-info">Rodada encerrada — edição desabilitada.</div>
    @endif

    <a href="{{ route('rodadas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
