@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #156DAF;">
                    <h5 class="text-white">Editar Canal: {{ $canal->nome }}</h5>
                </div>

                <div class="card-body" style="background-color: #e9e9e9;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('canais.update', $canal->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nome do Canal</label>
                            <input type="text" name="nome" class="form-control" value="{{ old('nome', $canal->nome) }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">CEP</label>
                                <input type="text" name="cep" class="form-control" value="{{ old('cep', $canal->cep) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cidade</label>
                                <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $canal->cidade) }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">UF</label>
                                <input type="text" name="estado" class="form-control" value="{{ old('estado', $canal->estado) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">URL do Canal</label>
                            <input type="url" name="url" class="form-control" value="{{ old('url', $canal->url) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo do Canal</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            @if($canal->logo)
                                <img src="{{ asset('storage/' . $canal->logo) }}" alt="Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsável</label>
                            <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel', $canal->responsavel) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $canal->telefone) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $canal->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Função</label>
                            <input type="text" name="funcao" class="form-control" value="{{ old('funcao', $canal->funcao) }}" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn" style="background-color: #156DAF; color: white;">
                                Atualizar Canal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
