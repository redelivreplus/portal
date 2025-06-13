@extends('layouts.app')

@section('content')
<style>
    .btn-outline-secondary {
        color: #156DAF;
        border-color: #156DAF;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #156DAF !important;
        color: #fff !important;
        border-color: #156DAF !important;
    }
</style>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">

                <div class="card shadow-sm border-0">
                    {{-- Faixa azul superior com título --}}
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Cadastrar Novo Canal</h5>
                    </div>

                    {{-- Corpo do card em cinza claro --}}
                    <div class="card-body" style="background-color: #e9e9e9;">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('canais.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nome do Canal</label>
                                <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">CEP</label>
                                    <div class="input-group">
                                        <input type="text" id="cep" name="cep" class="form-control" maxlength="9">
                                        <button class="btn btn-outline-secondary" type="button" id="buscarCep">🔍</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" required readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">UF</label>
                                    <input type="text" name="estado" id="estado" class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL do Canal</label>
                                <input type="url" name="url" class="form-control" value="{{ old('url') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Logo do Canal</label>
                                <input type="file" name="logo" class="form-control" accept="image/*" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label">Responsável</label>
                                    <input type="text" name="responsavel" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Função</label>
                                    <input type="text" name="funcao" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="termos" required>
                                <label class="form-check-label" for="termos">
                                    Eu li e concordo com os <a href="{{ route('responsabilidade') }}">Termos de Responsabilidade</a>.
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn" style="background-color: #156DAF; color: white;">
                                    Salvar Canal
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('cep').addEventListener('blur', function () {
    var cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(() => alert('Erro ao buscar o CEP.'));
    }
});
</script>
@endsection
