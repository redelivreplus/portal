@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Criar Nova Rodada</h5>
                    </div>

                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('rodadas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Título da Rodada</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prêmio</label>
                                <input type="text" name="premio_rodada" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de Jogos (máximo 25)</label>
                                <input type="number" name="quantidade_jogos" id="quantidade_jogos" class="form-control" value="5" min="1" max="25" required>
                                <small id="quantidade_jogos_erro" class="text-danger d-none">Máximo de 25 jogos permitido.</small>
                            </div>

                            <div id="jogos-container">
                                {{-- Gerado dinamicamente via JS --}}
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Salvar Rodada e Jogos</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- JS para gerar os campos dos jogos --}}
<script>
    function criarCamposJogos(qtd) {
        const container = document.getElementById('jogos-container');
        const erroSpan = document.getElementById('quantidade_jogos_erro');

        if (qtd > 25) {
            erroSpan.classList.remove('d-none');
            container.innerHTML = '';
            return;
        } else {
            erroSpan.classList.add('d-none');
        }

        container.innerHTML = '';

        for (let i = 1; i <= qtd; i++) {
            container.innerHTML += `
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Jogo ${i}</h5>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label">Escudo Time A</label>
                                <input type="file" name="jogos[${i}][escudo_a]" class="form-control mb-2" accept="image/*" required>
                                <input type="text" name="jogos[${i}][time_a]" class="form-control" placeholder="Nome do Time A" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-center justify-content-center fw-bold fs-4">X</div>
                            <div class="col-md-5">
                                <label class="form-label">Escudo Time B</label>
                                <input type="file" name="jogos[${i}][escudo_b]" class="form-control mb-2" accept="image/*" required>
                                <input type="text" name="jogos[${i}][time_b]" class="form-control" placeholder="Nome do Time B" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('quantidade_jogos');
        criarCamposJogos(parseInt(input.value));

        input.addEventListener('input', function () {
            const qtd = parseInt(this.value);
            if (!isNaN(qtd)) criarCamposJogos(qtd);
        });
    });
</script>
@endsection
