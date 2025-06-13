<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Painel Administrativo</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    .faixa-topo {
      background-color: #003366;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      font-size: 20px;
      font-weight: bold;
    }

    .usuario-topo {
      font-size: 16px;
      font-weight: normal;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .btn-sair {
      background-color: #ff4d4d;
      border: none;
      padding: 7px 14px;
      border-radius: 4px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-sair:hover {
      background-color: #cc0000;
    }

    .sidebar {
      position: fixed;
      top: 55px;
      left: 0;
      width: 220px;
      height: calc(100vh - 55px);
      background-color: #003366;
      padding-top: 20px;
      color: white;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
    }

    .sidebar a {
      display: block;
      padding: 12px 25px;
      color: white;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s ease;
      border-left: 4px solid transparent;
      cursor: pointer;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #00509e;
      border-left: 4px solid #ffcc00;
    }

    .conteudo {
      margin-left: 220px;
      padding: 80px 30px 30px 30px;
      min-height: 100vh;
      background-color: #f9f9f9;
    }

    h1 {
      margin-bottom: 15px;
      color: #333;
    }

    p {
      font-size: 18px;
      color: #555;
      margin-bottom: 30px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #007BFF;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    iframe#iframe-quiz {
      width: 100%;
      height: calc(100vh - 110px);
      border: none;
    }
  </style>
</head>
<body>
  <!-- Topo -->
  <div class="faixa-topo">
    <div>Painel Administrativo</div>
    <div class="usuario-topo" id="usuarioTopo">
      <!-- Preenchido via JavaScript -->
    </div>
  </div>

  <!-- Menu lateral -->
 <nav class="sidebar">
  <h2>Menu</h2>
  <a id="menu-inicio" class="active" onclick="carregarConteudo('dashboard')">Início</a>
  <a id="menu-sobre" onclick="carregarConteudo('sobre')">Sobre</a>
  <a id="menu-servicos" onclick="carregarConteudo('servicos')">Serviços</a>
  <a id="menu-contato" onclick="carregarConteudo('contato')">Contato</a>
  <a id="menu-quiz" onclick="carregarQuiz()">Placar premiado</a>
  <a id="menu-numeros" onclick="carregarNumeroSorte()">Número da Sorte</a>
</nav>

  <!-- Área principal -->
  <main class="conteudo" id="conteudo-principal">
    <!-- Conteúdo será carregado dinamicamente -->
  </main>

  <script>
  const usuarioNome = 'João Silva';

  function atualizarUsuarioTopo() {
    const container = document.getElementById('usuarioTopo');
    container.innerHTML = `
      <span>Olá, ${usuarioNome}</span>
      <button class="btn-sair" onclick="logout()">Sair</button>
    `;
  }

  function logout() {
    window.location.href = 'http://redelivre.local';
  }

  const paginas = {
    dashboard: `<h1>Dashboard</h1><p>Bem-vindo ao seu painel de controle.</p>
      <button onclick="alert('Dashboard funcionando!')">Clique no Dashboard</button>`,
    sobre: `<h1>Sobre Nós</h1><p>Essa página contém informações sobre a empresa.</p>`,
    servicos: `<h1>Serviços</h1><p>Veja os serviços que oferecemos.</p>`,
    contato: `<h1>Contato</h1><p>Fale conosco pelo formulário abaixo:</p>
      <form onsubmit="event.preventDefault(); alert('Formulário enviado!')">
        <input type="text" placeholder="Seu nome" required style="padding:8px; width: 100%; margin-bottom:10px;" />
        <input type="email" placeholder="Seu email" required style="padding:8px; width: 100%; margin-bottom:10px;" />
        <textarea placeholder="Sua mensagem" required style="padding:8px; width: 100%; margin-bottom:10px;"></textarea>
        <button type="submit">Enviar</button>
      </form>`
  };

  function carregarConteudo(pagina) {
    const conteudo = document.getElementById('conteudo-principal');
    conteudo.innerHTML = paginas[pagina] || '<p>Página não encontrada.</p>';
    limparIframes();

    document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
    const ativo = document.getElementById('menu-' + pagina);
    if (ativo) ativo.classList.add('active');
  }

  function carregarQuiz() {
    const conteudo = document.getElementById('conteudo-principal');
    conteudo.innerHTML = '';

    const iframe = document.createElement('iframe');
    iframe.id = 'iframe-quiz';
    iframe.src = 'http://redelivre.local/admin/quiz/create';
    iframe.title = 'Quiz';

    conteudo.appendChild(iframe);

    limparMenusAtivos();
    document.getElementById('menu-quiz').classList.add('active');
  }

  function carregarNumeroSorte() {
    const conteudo = document.getElementById('conteudo-principal');
    conteudo.innerHTML = '';

    const iframe = document.createElement('iframe');
    iframe.id = 'iframe-quiz';
    iframe.src = 'http://redelivre.local/admin/numeros-da-sorte';
    iframe.title = 'Número da Sorte';

    conteudo.appendChild(iframe);

    limparMenusAtivos();
    document.getElementById('menu-numeros').classList.add('active');
  }

  function limparMenusAtivos() {
    document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
  }

  function limparIframes() {
    const iframe = document.getElementById('iframe-quiz');
    if (iframe) iframe.remove();
  }

  window.onload = () => {
    atualizarUsuarioTopo();
    carregarConteudo('dashboard');
  };
</script>
</body>
</html>
