@extends('layouts.pag')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary fw-bold">Cadastrar Novo Jogo</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <!-- Formulário de criação de jogo -->
    <div class="card shadow-sm mb-4 border border-primary" style="background-color: #e7f1ff;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.quiz.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-1">
                        <label for="escudo_home" class="form-label">🏠 Escudo</label>
                        <div class="input-group">
                            <label class="input-group-text btn btn-success" for="escudo_home">Uploads</label>
                            <input type="file" name="escudo_home" id="escudo_home" class="form-control d-none @error('escudo_home') is-invalid @enderror" accept="image/*">
                        </div>
                        @error('escudo_home') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="team_home" class="form-label">🏠 Time Casa</label>
                        <input type="text" name="team_home" id="team_home" class="form-control @error('team_home') is-invalid @enderror" value="{{ old('team_home') }}" required>
                        @error('team_home') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="team_away" class="form-label">🚗 Time Visitante</label>
                        <input type="text" name="team_away" id="team_away" class="form-control @error('team_away') is-invalid @enderror" value="{{ old('team_away') }}" required>
                        @error('team_away') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-1">
                        <label for="escudo_away" class="form-label">🚗 Escudo</label>
                        <div class="input-group">
                            <label class="input-group-text btn btn-success" for="escudo_away">Uploads</label>
                            <input type="file" name="escudo_away" id="escudo_away" class="form-control d-none @error('escudo_away') is-invalid @enderror" accept="image/*">
                        </div>
                        @error('escudo_away') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="match_date" class="form-label">📅 Data do Jogo</label>
                        <input type="date" name="match_date" id="match_date" class="form-control @error('match_date') is-invalid @enderror" value="{{ old('match_date') }}" required>
                        @error('match_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-1">
                        <label for="match_time" class="form-label">⏰ Horário</label>
                        <input type="time" name="match_time" id="match_time" class="form-control @error('match_time') is-invalid @enderror" value="{{ old('match_time') }}" required>
                        @error('match_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="width: 200px;">✅ Criar Jogo</button>
                </div>
            </form>
        </div>
    </div>

    <h4>Jogos Cadastrados</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Time Casa</th>
                <th>Placar</th>
                <th>Time Visitante</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jogos as $jogo)
                <tr>
                    <td>{{ strtoupper($jogo->team_home) }}</td>
                    <td>
                        @if(is_null($jogo->score_home) || is_null($jogo->score_away))
                            <span class="text-muted">--</span>
                        @else
                            <strong>{{ $jogo->score_home }} x {{ $jogo->score_away }}</strong>
                        @endif
                    </td>
                    <td>{{ strtoupper($jogo->team_away) }}</td>
                    <td>{{ \Carbon\Carbon::parse($jogo->match_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($jogo->match_time)->format('H:i') }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick='abrirModal(@json($jogo))'>
                            ✏️ Editar Placar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="modalPlacar" tabindex="-1" aria-labelledby="modalPlacarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="formEditarPlacar" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="modalPlacarLabel">Editar Placar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <h5 class="text-center mb-3" id="nomeTimes">TIME A x TIME B</h5>

        <div class="row">
            <div class="col">
                <label for="editGolsTimeCasa" class="form-label">Gols <span id="labelTimeCasa">Time Casa</span></label>
                <input type="number" class="form-control" id="editGolsTimeCasa" name="score_home" min="0" required>
            </div>
            <div class="col">
                <label for="editGolsTimeVisitante" class="form-label">Gols <span id="labelTimeVisitante">Time Visitante</span></label>
                <input type="number" class="form-control" id="editGolsTimeVisitante" name="score_away" min="0" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
</div>

<script>
    const urlUpdateBase = "{{ route('admin.quiz.update', ['quizMatch' => '__ID__']) }}";

    function abrirModal(jogo) {
        const form = document.getElementById('formEditarPlacar');
        form.action = urlUpdateBase.replace('__ID__', jogo.slug);

        document.getElementById('nomeTimes').textContent =
            jogo.team_home.toUpperCase() + ' x ' + jogo.team_away.toUpperCase();

        document.getElementById('editGolsTimeCasa').value = jogo.score_home ?? '';
        document.getElementById('editGolsTimeVisitante').value = jogo.score_away ?? '';

        document.getElementById('labelTimeCasa').textContent = jogo.team_home.toUpperCase();
        document.getElementById('labelTimeVisitante').textContent = jogo.team_away.toUpperCase();

        const modal = new bootstrap.Modal(document.getElementById('modalPlacar'));
        modal.show();
    }
</script>
@endsection
