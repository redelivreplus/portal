<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Sorteio Ao Vivo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet" />
  <style>
    body {
      background-color: #00FF00;
      margin: 0;
      padding: 20px;
      font-family: 'Roboto', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #156DAF;
      font-size: 32px;
      margin-bottom: 30px;
    }

    .circles {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 40px;
    }

    .circle {
      width: 130px;
      height: 130px;
      background-color: #156DAF;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #FBC02D;
      font-size: 130px;
      font-weight: 700;
      transition: transform 0.2s ease-in-out;
    }

    .circle.animando {
      transform: rotate(15deg) scale(1.05);
    }

    .btn-sortear {
      padding: 15px 40px;
      background-color: #FBC02D;
      border: none;
      border-radius: 8px;
      color: #156DAF;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-sortear:hover {
      background-color: #e5ab00;
    }
  </style>
</head>
<body>
  <h1>Sorteio Ao Vivo</h1>
  <div class="circles" id="circles-container"></div>
  <button class="btn-sortear" id="sortearBtn">Sortear</button>

  <!-- Modal Ganhador -->
  <!-- Modal Ganhador -->
<div class="modal fade" id="modalGanhador" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white justify-content-center">
        <h5 class="modal-title fw-semibold" id="modalLabel">🎉 Prêmio Sorteado</h5>
      </div>
      <div class="modal-body px-5 py-4 text-start" style="font-size: 1.05rem;">
        <div class="mb-3">
          <span class="fw-semibold">Ganhador:</span>
          <span id="ganhadorNome" class="d-inline-block ms-1 text-decoration-underline" style="min-width: 250px;">Aguardando...</span>
        </div>
        <div class="mb-3">
          <span class="fw-semibold">Cidade:</span>
          <span id="ganhadorCidade" class="ms-1 text-decoration-underline" style="min-width: 180px;">-</span>
          <span class="fw-semibold ms-4">UF:</span>
          <span id="ganhadorUF" class="ms-1 text-decoration-underline" style="min-width: 40px;">-</span>
        </div>
        <div>
          <span class="fw-semibold">Telefone:</span>
          <span id="ganhadorFone" class="ms-1 text-decoration-underline" style="min-width: 200px;">-</span>
          <span class="fw-semibold ms-4">Time:</span>
          <span id="ganhadorTime" class="ms-1 text-decoration-underline" style="min-width: 130px;">-</span>
        </div>
      </div>
      <div class="modal-footer justify-content-center border-0 pb-4">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <script>
    const container = document.getElementById('circles-container');
    const btnSortear = document.getElementById('sortearBtn');
    const total = 7;
    const circles = [];

    const somMoeda = new Audio('/sounds/coin.mp3');
    const somAplausos = new Audio('/sounds/aplausos.mp3');

    for (let i = 0; i < total; i++) {
      const c = document.createElement('div');
      c.className = 'circle';
      c.textContent = '0';
      container.appendChild(c);
      circles.push(c);
    }

    async function sortearTodos() {
      btnSortear.disabled = true;

      const resposta = await fetch('/admin/sortear/numero');
      const json = await resposta.json();

      if (!json.numero) {
        alert('Erro ao sortear número.');
        btnSortear.disabled = false;
        return;
      }

      const numeroSorteado = json.numero.toString().padStart(7, '0').split('');
      let i = 0;

      function sortearProximo() {
        if (i >= circles.length) {
          finalizarComEstilo(json.numero);
          btnSortear.disabled = false;
          return;
        }

        const circle = circles[i];
        const finalDigit = numeroSorteado[i];
        const duracao = 2000;

        animarCirculo(circle, finalDigit, duracao, () => {
          i++;
          setTimeout(sortearProximo, 1000);
        });
      }

      sortearProximo();
    }

    function animarCirculo(circulo, valorFinal, duracao, callback) {
      circulo.classList.add('animando');
      const start = performance.now();

      function frame(now) {
        const tempo = now - start;
        if (tempo < duracao) {
          circulo.textContent = Math.floor(Math.random() * 10);
          requestAnimationFrame(frame);
        } else {
          circulo.classList.remove('animando');
          circulo.textContent = valorFinal;
          somMoeda.currentTime = 0;
          somMoeda.play().catch(() => {});
          if (callback) callback();
        }
      }

      requestAnimationFrame(frame);
    }

    function finalizarComEstilo(numeroFinal) {
      somAplausos.currentTime = 0;
      somAplausos.play().catch(() => {});

      const duracao = 8000;
      const fim = Date.now() + duracao;

      const base = {
        startVelocity: 25,
        spread: 360,
        ticks: 160,
        zIndex: 1000,
        scalar: 1.2,
        decay: 0.92
      };

      const timer = setInterval(() => {
        if (Date.now() > fim) {
          clearInterval(timer);
        } else {
          confetti(Object.assign({}, base, {
            particleCount: 70,
            origin: { x: Math.random(), y: Math.random() * 0.6 },
            shapes: ['square', 'circle'],
            colors: ['#FBC02D', '#156DAF', '#FF4081', '#4CAF50']
          }));
        }
      }, 250);

      setTimeout(() => {
        fetch(`/admin/ganhador/buscar?numero=${numeroFinal}`)
          .then(res => res.json())
          .then(data => {
            document.getElementById('modalLabel').textContent =
              data.posicao && data.premio ? `${data.posicao}º Prêmio - ${data.premio}` : 'Prêmio Sorteado';

            document.getElementById('ganhadorNome').textContent = data.nome || '---';
            document.getElementById('ganhadorCidade').textContent = data.cidade || '---';
            document.getElementById('ganhadorUF').textContent = data.uf || '--';
            document.getElementById('ganhadorFone').textContent = data.fone || '(--) - ----';
            document.getElementById('ganhadorTime').textContent = data.time || '---';

            new bootstrap.Modal(document.getElementById('modalGanhador')).show();
          })
          .catch(() => {
            document.getElementById('modalLabel').textContent = 'Prêmio Sorteado';
            document.getElementById('ganhadorNome').textContent = 'Erro ao buscar ganhador';
            document.getElementById('ganhadorCidade').textContent = '-';
            document.getElementById('ganhadorUF').textContent = '-';
            document.getElementById('ganhadorFone').textContent = '-';
            document.getElementById('ganhadorTime').textContent = '-';

            new bootstrap.Modal(document.getElementById('modalGanhador')).show();
          });
      }, 1000);
    }

    btnSortear.addEventListener('click', sortearTodos);
 </script>
</body>
</html>




