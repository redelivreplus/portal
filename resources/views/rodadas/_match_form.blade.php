<div class="card mb-3 p-3 match-form" data-index="{{ $index }}">
    <h5>Jogo {{ $index + 1 }}</h5>

    <div class="mb-2">
        <label for="matches_{{ $index }}_team_a" class="form-label">Time A</label>
        <input 
            type="text" 
            name="matches[{{ $index }}][team_a]" 
            id="matches_{{ $index }}_team_a" 
            class="form-control @error("matches.$index.team_a") is-invalid @enderror" 
            value="{{ old("matches.$index.team_a", $match->team_a ?? '') }}" 
            required
        >
        @error("matches.$index.team_a")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="matches_{{ $index }}_team_b" class="form-label">Time B</label>
        <input 
            type="text" 
            name="matches[{{ $index }}][team_b]" 
            id="matches_{{ $index }}_team_b" 
            class="form-control @error("matches.$index.team_b") is-invalid @enderror" 
            value="{{ old("matches.$index.team_b", $match->team_b ?? '') }}" 
            required
        >
        @error("matches.$index.team_b")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-danger remove-match">Remover Jogo</button>
    <hr>
</div>
