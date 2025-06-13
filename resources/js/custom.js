window.abrirModal = function(jogo) {
    const form = document.getElementById('formEditarPlacar');
    form.action = '/quiz/' + jogo.id;

    document.getElementById('nomeTimes').textContent = jogo.team_home.toUpperCase() + ' x ' + jogo.team_away.toUpperCase();
    document.getElementById('editGolsTimeCasa').value = jogo.score_home ?? '';
    document.getElementById('editGolsTimeVisitante').value = jogo.score_away ?? '';

    document.getElementById('labelTimeCasa').textContent = jogo.team_home.toUpperCase();
    document.getElementById('labelTimeVisitante').textContent = jogo.team_away.toUpperCase();

    const modal = new bootstrap.Modal(document.getElementById('modalPlacar'));
    modal.show();
};
