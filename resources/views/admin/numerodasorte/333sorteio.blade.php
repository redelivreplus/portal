@extends('layouts.app')


@section('content')
<div class="container mt-4">

    <h2>Sorteio de Prêmios</h2>

    {{-- Inputs para sorteador (exemplo, pode ser outro mecanismo) --}}
    <div class="mb-3">
        <label for="numero" class="form-label">Número sorteado (7 dígitos)</label>
        <input type="text" class="form-control" id="numero" maxlength="7" placeholder="Ex: 5236897">
    </div>

    <div class="mb-3">
        <label for="posicao" class="form-label">Posição do prêmio (1 a 5)</label>
        <select id="posicao" class="form-select">
            <option value="1">1º Prêmio</option>
            <option value="2">2º Prêmio</option>
            <option value="3">3º Prêmio</option>
            <option value="4">4º Prêmio</option>
            <option value="5">5º Prêmio</option>
        </select>
    </div>

    <button id="btnSortear" class="btn btn-primary">Sortear</button>

</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalGanhador" tabindex="-1" aria-labelledby="modalGanhadorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalGanhadorLabel">Resultado do Sorteio</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p><strong><span id="premioPosicao"></span>:</strong> <span id="numeroGanhador"></span></p>
        <p><strong>Ganhador:</strong> <span id="nomeGanhador"></span></p>
        <p><strong>Cidade:</strong> <span id="cidadeGanhador"></span></p>
        <p><strong>UF:</strong> <span id="ufGanhador"></span></p>
        <p><strong>Telefone:</strong> <span id="telefoneGanhador"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('btnSortear').addEventListener('click', function () {
    const numero = document.getElementById('numero').value.trim();
    const posicao = document.getElementById('posicao').value;

    if (!/^\d{7}$/.test(numero)) {
        alert('Informe um número válido com 7 dígitos');
        return;
    }

    fetch("{{ route('admin.sorteio.sortear') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            numero: numero,
            posicao: parseInt(posicao)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Erro: ' + data.error);
            return;
        }

        // Preenche o modal com os dados retornados
        document.getElementById('premioPosicao').textContent = data.posicao + 'º Prêmio';
        document.getElementById('numeroGanhador').textContent = data.numero;
        document.getElementById('nomeGanhador').textContent = data.ganhador;
        document.getElementById('cidadeGanhador').textContent = data.cidade;
        document.getElementById('ufGanhador').textContent = data.uf;
        document.getElementById('telefoneGanhador').textContent = data.telefone;

        // Abre o modal
        var myModal = new bootstrap.Modal(document.getElementById('modalGanhador'));
        myModal.show();

    })
    .catch(error => {
        alert('Erro ao realizar sorteio. Tente novamente.');
        console.error(error);
    });
});
</script>
@endsection
