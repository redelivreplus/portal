<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Números da Sorte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control[readonly] {
            background-color: #f1f1f1;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<div class="container mt-5" style="background-color: #dcdcdc;">
    <h2 class="mb-4">Números da Sorte</h2>

    <!-- Botão de Sorteio -->
    <a href="{{ route('admin.numerodasorte.numero') }}" class="btn btn-primary mb-5"
       style="width: 450px; height: 200px; display: inline-flex; align-items: center; justify-content: center; font-size: 3rem;">
        🎰 Sorteio
    </a>

    @if(session('status'))
        <div id="alert-status" class="alert alert-success w-75 mx-auto text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- Criar novo sorteio -->
    <div class="card mb-4" style="background-color: #e9e9e9;">
        <div class="card-body">
            <h5 class="card-title">Criar Sorteio</h5>
            <form action="{{ route('admin.sorteios.store') }}" method="POST" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-3">
                    <label for="descricao" class="form-label">Descrição do Sorteio</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" name="data" id="data" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" name="hora" id="hora" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100" {{ $totalNumeros > 0 ? 'disabled' : '' }}>
                        Criar Sorteio
                    </button>
                    @if($totalNumeros > 0)
                        <small class="text-danger mt-2 d-block text-center">
                            ⚠️ Para criar um novo sorteio, limpe os números da sorte existentes.
                        </small>
                    @endif
                </div>
            </form>
        </div>

        @if($sorteioAtivo)
            <div class="alert alert-info text-center mt-2">
                Próximo Sorteio: <strong>{{ $sorteioAtivo->descricao }}</strong> —
                {{ \Carbon\Carbon::parse($sorteioAtivo->data)->format('d/m/Y H:i') }}
            </div>
        @endif

        <!-- Prêmios -->
        @php $premios = $premios ?? collect(); @endphp
        <div class="d-flex justify-content-center mt-4">
            <div class="text-center" style="width: 100%; max-width: 850px; background-color: #e9e9e9; padding: 20px; border-radius: 8px;">
                <h4 class="mb-4">Prêmios</h4>
                <form action="{{ route('admin.premios.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        @for($col = 0; $col < 2; $col++)
                            <div class="col-md-6">
                                @for($i = 1 + $col * 10; $i <= 10 + $col * 10; $i++)
                                    @php
                                        $premio = $premios->get($i);
                                        $descricao = $premio->descricao ?? '';
                                        $jaCadastrado = !empty($descricao);
                                    @endphp
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="me-2" style="width: 30px;">{{ $i }}º</label>
                                        <input type="text"
                                               name="premios[{{ $i }}]"
                                               id="premio_{{ $i }}"
                                               class="form-control form-control-sm me-2 premio-input {{ $jaCadastrado ? 'text-bg-light' : '' }}"
                                               value="{{ $descricao }}"
                                               placeholder="Prêmio {{ $i }}"
                                               {{ $jaCadastrado ? 'readonly' : '' }}>
                                        @if($jaCadastrado)
                                            <div class="form-check ms-2">
                                                <input class="form-check-input permitir-edicao"
                                                       type="checkbox"
                                                       data-target="#premio_{{ $i }}"
                                                       id="editar_{{ $i }}">
                                            </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>

                    <div class="form-check mt-4 d-flex justify-content-center">
                        <input class="form-check-input me-2" type="checkbox" name="premio_extra" id="premio_extra">
                        <label class="form-check-label" for="premio_extra">Liberar prêmio extra</label>
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Cadastrar prêmios preenchidos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Limpar números -->
    <form action="{{ route('admin.numeros.limpar') }}" method="POST" id="form-limpar" class="mt-4">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-center mt-3">
            <button type="button" class="btn btn-danger btn-sm px-3 py-2"
                    data-bs-toggle="modal" data-bs-target="#modalConfirmacao" style="font-size: 0.9rem;">
                🧹 Limpar números da sorte
            </button>
        </div>
    </form>
</div>

<!-- Modal confirmação -->
<div class="modal fade" id="modalConfirmacao" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning-subtle">
                <h5 class="modal-title" id="modalLabel">Confirmação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body text-center">
                Tem certeza que deseja apagar todos os números da sorte?<br>
                <strong>Esta ação não poderá ser desfeita.</strong>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('form-limpar').submit();">
                    Sim, apagar tudo
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.permitir-edicao');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const input = document.querySelector(this.dataset.target);
                if (this.checked) {
                    input.removeAttribute('readonly');
                    input.classList.remove('text-bg-light');
                    input.classList.add('bg-success', 'text-white');
                } else {
                    input.setAttribute('readonly', true);
                    input.classList.remove('bg-success', 'text-white');
                    input.classList.add('text-bg-light');
                }
            });
        });

        const alerta = document.getElementById('alert-status');
        if (alerta) {
            setTimeout(() => alerta.style.display = 'none', 4000);
        }
    });
</script>
</body>
</html>
