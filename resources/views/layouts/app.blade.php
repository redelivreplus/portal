<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'REDE LIVRE') }}</title>

  <!-- Bootstrap CSS (via Vite) -->
@vite(['resources/js/app.js', 'resources/css/app.css'])


  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

  <style>
    .top-bar {
      background-color: #156DAF;
      color: white;
      padding: 2px 0;
    }

    .navbar-custom {
      background-color: #156DAF;
    }

    .navbar-nav .nav-link {
      font-size: 1rem;
      font-weight: 600;
      color: white !important;
    }

    footer {
      background-color: #003366;
      color: white;
      padding: 2px 0;
    }

    .social-icons a {
      color: white;
      font-size: 20px;
      margin: 0 10px;
    }

    .date-info {
      font-size: 16px;
      font-weight: bold;
    }

    .game-result-quiz {
      font-size: 14px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #003366;
      color: white;
      padding: 5px 15px;
      border-radius: 5px;
    }

    .game-result-quiz span {
      margin-right: 20px;
    }

    .game-result-quiz a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .footer-top-bar {
      background-color: #156DAF;
      color: white;
      padding: 4px 0;
    }

    .footer-logo-block {
      width: 120px;
      text-align: center;
      margin-right: 30px;
    }

    .footer-logo-block img {
      max-height: 80px;
      display: block;
      margin: 0 auto;
    }

    .footer-logo-block .logo-text {
      font-size: 1rem;
      font-weight: bold;
      margin-top: 6px;
    }
	
	.table thead.table-dark {
    background-color: #156DAF !important;
}

	
	
  </style>

  @yield('styles')
</head>
<body>

  <!-- Top bar -->
  <div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="date-info" id="date"></div>

      @if(isset($ultimoJogo))
      <div class="game-result-quiz" style="display: flex; align-items: center; gap: 10px;">
          @if($ultimoJogo->escudo_home)
              <img src="{{ asset('storage/' . $ultimoJogo->escudo_home) }}" alt="{{ $ultimoJogo->team_home }}" style="height: 40px;">
          @endif

          <span style="font-weight: bold;">{{ strtoupper($ultimoJogo->team_home) }}</span>

          <span style="font-weight: bold; margin: 0 8px;">
              @if(!is_null($ultimoJogo->score_home) && !is_null($ultimoJogo->score_away))
                  {{ $ultimoJogo->score_home }} x {{ $ultimoJogo->score_away }}
              @else
                  x
              @endif
          </span>

          <span style="font-weight: bold;">{{ strtoupper($ultimoJogo->team_away) }}</span>

          @if($ultimoJogo->escudo_away)
              <img src="{{ asset('storage/' . $ultimoJogo->escudo_away) }}" alt="{{ $ultimoJogo->team_away }}" style="height: 40px;">
          @endif

          <a href="{{ route('palpites.index') }}" class="btn btn-sm btn-warning" style="margin-left: 15px;">Placar premiado</a>
      </div>
      @endif

      <div class="social-icons d-flex justify-content-center">
        <a href="https://api.whatsapp.com/send?phone=5562992349820&text=Seja+bem-vindo+a+Rede+Livre" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.instagram.com/redelivrego/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/@redelivrego" target="_blank"><i class="fab fa-youtube"></i></a>
        <a href="https://play.google.com/store/apps/details?id=br.com.tva7.redelivre" target="_blank"><i class="fab fa-google-play"></i></a>
      </div>

      <div class="user-icon text-white">
    <i class="fas fa-user me-2"></i>
    @if(Auth::check())
        <a href="{{ route('perfil.show', Auth::user()->profile_slug) }}" class="text-white text-decoration-none">
            {{ Auth::user()->name }}
        </a> |
        <a href="{{ route('logout') }}" class="text-white text-decoration-none"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" class="text-white text-decoration-none">Entrar</a>
    @endif
</div>

    </div>
  </div>

  <!-- Header -->
  <header class="py-3 border-bottom bg-white">
    <div class="container d-flex justify-content-between align-items-center">
      <a href="{{ url('/') }}" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Rede Livre GO" height="110">
      </a>

      <div class="d-none d-md-block flex-grow-1 mx-3">
        <img src="{{ asset('images/banners/Banner topo.gif') }}" alt="Banner Principal" class="img-fluid">
      </div>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
      <a class="navbar-brand d-lg-none text-white" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">HOME</a></li>
		  <li class="nav-item"><a class="nav-link text-white px-3" href="{{ url('canais/') }}">TV ao VIVO</a></li>
		  <li class="nav-item"><a class="nav-link text-white px-3" href="{{ url('canais/') }}">RADIO ao VIVO</a></li>
		  
		  
          <li class="nav-item"><a class="nav-link" href=""></a></li>
        </ul>

        <form class="d-flex" role="search">
          <input class="form-control form-control-sm me-2" type="search" placeholder="Pesquisar" aria-label="Search">
          <button class="btn btn-outline-light btn-sm" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <main class="py-5">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <!-- Faixa extra acima do rodapé -->
  <div class="footer-top-bar">
    <div class="container d-flex align-items-center">
      <div class="footer-logo-block">
        <img src="{{ asset('images/logo.png') }}" alt="Rede Livre GO">
        <div class="logo-text">Rede Livre</div>
      </div>

      <div>
     
        <div style="font-size: 1.2rem;">
          <div style="text-align: center; margin-top: 15px;">
            <ul style="display: inline-flex; gap: 40px; list-style: none; padding: 0; margin: 0;">
              <li><a href="{{ route('sobre') }}" style="color: white; text-decoration: none;">Sobre nós</a></li>
              <li><a href="{{ route('expediente') }}" style="color: white; text-decoration: none;">Expediente</a></li>
              <li><a href="{{ route('privacidade') }}" style="color: white; text-decoration: none;">Política de Privacidade</a></li>
              <li><a href="{{ route('termos') }}" style="color: white; text-decoration: none;">Termos de Uso</a></li>
			   <li><a href="{{ route('faleconosco') }}" style="color: white; text-decoration: none;">Fale Conosco</a></li>
            </ul>
          </div>
        </div>
		<br>
		
		       <div style="font-size: 1.1rem; font-weight: bold;">Endereço: Rua Augusta Qd 71 Lt 01 C-07/203 Ed. Parque das Nações III - Parque das Nações - Aparecida de Goiânia CEP: 74.957-090</div>
		
		
      </div>
    </div>
  </div>

  <!-- Rodapé -->
  <footer>
    <div class="container text-center">
      <p class="mb-0">© {{ date('Y') }} Rede Livre de comunicação ltda. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Scripts -->
  @vite('resources/js/app.js')

  {{-- Atualiza Data no Topo --}}
  <script>
    function updateDate() {
      const today = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById("date").textContent = today.toLocaleDateString('pt-BR', options);
    }
    updateDate();
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @stack('scripts')




</body>
</html>
