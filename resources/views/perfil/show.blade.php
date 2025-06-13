@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Card com faixa azul limpa no topo --}}
                <div class="card border-0 shadow-sm">

                    {{-- Faixa azul limpa (sem conteúdo) --}}
                    <div class="faixa-topo">
                        <p>
                            🎯 <strong>Rei do Palpite</strong> cravou o resultado &nbsp;&nbsp;•&nbsp;&nbsp;
                            ✅ <strong>Bom de Palpite</strong> acertou o vencedor/empate &nbsp;&nbsp;•&nbsp;&nbsp;
                            ❌ <strong>Pé Frio</strong> errou tudo
                        </p>
                    </div>

                    <div class="card-body" style="background-color: #e9e9e9;">
                        <div class="d-flex align-items-center">

                            {{-- Foto de perfil ou slug --}}
                            <div class="me-4">
                                @if($user->profile_image_url)
                                    <img src="{{ asset('storage/' . $user->profile_image_url) }}" alt="Foto de perfil"
                                         class="rounded-circle"
                                         style="width: 160px; height: 160px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white text-center"
                                         style="width: 160px; height: 160px; font-size: 28px; padding: 10px;">
                                        {{ $user->profile_slug }}
                                    </div>
                                @endif
                            </div>

                            {{-- Informações do usuário e botões --}}
                            <div class="flex-grow-1 d-flex">
                                {{-- Esquerda --}}
                                <div style="flex: 1; padding-right: 15px;">
                                    <h2 class="mb-1 fs-2" style="color: #003366;">{{ $user->name }}</h2>
                                    <p class="fs-5 mb-1" style="color: #003366;">{{ $user->profile_slug }}</p>

                                    <p class="mb-3" style="color: #003366; font-weight: 500; display: flex; align-items: center; gap: 15px;">
                                        <span><i class="fas fa-user-friends me-1"></i> Seguidores: {{ $user->followers()->count() }}</span>
                                        <span><i class="fas fa-user-check me-1"></i> Seguindo: {{ $user->following()->count() }}</span>
                                    </p>

                                    @if($user->show_bio && $user->bio)
                                        <p class="mb-1" style="color: #003366;">
                                            <i class="fas fa-book me-1"></i>
                                            <strong>Biografia:</strong> {{ $user->bio }}
                                        </p>
                                    @endif

                                    @if($user->show_interests && $user->interests)
                                        <p style="color: #003366;">
                                            <i class="fas fa-bullseye me-1"></i>
                                            <strong>Interesses:</strong> {{ $user->interests }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Direita --}}
                                <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-start; gap: 15px;">
                                    {{-- Botões de ação --}}
                                    <div class="text-end">
                                        @auth
                                            @if(auth()->user()->id !== $user->id)
                                                @if(auth()->user()->following->contains($user->id))
                                                    <form action="{{ route('perfil.desseguir', $user->profile_slug) }}" method="POST" class="d-inline me-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-user-minus me-1"></i> Deixar de seguir
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('perfil.seguir', $user->profile_slug) }}" method="POST" class="d-inline me-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                                            <i class="fas fa-user-plus me-1"></i> Seguir
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <a href="{{ route('perfil.edit', $user->profile_slug) }}" class="btn btn-primary btn-sm me-2">
                                                    <i class="fas fa-edit me-1"></i> Editar perfil
                                                </a>
                                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-sign-out-alt me-1"></i> Sair
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">
                                                <i class="fas fa-sign-in-alt me-1"></i> Entrar para seguir
                                            </a>
                                        @endguest
                                    </div>

                                    {{-- Troféu e estatísticas --}}
                                    @php
                                        $trophy = $user->trophy();
                                        $exatos = $user->totalAcertosExatos();
                                        $resultado = $user->totalAcertosResultado();
                                        $totalPalpites = $user->palpites()->count();
                                        $erroTudo = $totalPalpites - $exatos - $resultado;
                                        if ($erroTudo < 0) $erroTudo = 0;
                                    @endphp

                                    <div class="p-3 rounded text-center" style="font-weight: 600; color: #003366;">
                                        <div class="d-flex flex-column align-items-center">
                                            <span style="font-size: {{ $trophy['icon_size'] }};" title="Troféu do usuário">{{ $trophy['icon'] }}</span>
                                            <small class="mt-1">{{ $trophy['title'] }}</small>

                                            <div class="d-flex justify-content-center gap-3 mt-2" style="font-size: 1.2rem;">
                                                <span style="padding: 0 12px;">🎯 {{ $exatos }}</span>
                                                <span style="padding: 0 12px;">✅ {{ $resultado }}</span>
                                                <span style="padding: 0 12px;">❌ {{ $erroTudo }}</span>
                                            </div>

                                            <div class="d-flex justify-content-center align-items-center gap-2 mt-2" style="font-size: 0.9rem; color: #002244;">
                                                <span><strong>Total de palpites:</strong> {{ $totalPalpites }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Redes sociais do usuário --}}
                        <div class="mt-3">
                            @if($user->instagram_profile_url)
                                <a href="{{ $user->instagram_profile_url }}" target="_blank" class="btn btn-social btn-sm me-2">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            @endif
                            @if($user->facebook_profile_url)
                                <a href="{{ $user->facebook_profile_url }}" target="_blank" class="btn btn-social btn-sm me-2">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            @endif
                            @if($user->youtube_profile_url)
                                <a href="{{ $user->youtube_profile_url }}" target="_blank" class="btn btn-social btn-sm me-2">
                                    <i class="fab fa-youtube"></i> YouTube
                                </a>
                            @endif
                        </div>

                        {{-- Redes sociais da plataforma com ícones coloridos --}}
                        <div class="mt-5 text-center">
                            <p style="color: #003366; font-size: 1.1rem; font-weight: 500; margin-bottom: 8px;">
                                Siga nossas redes sociais
                            </p>
                            <div class="d-flex justify-content-center gap-4">
                                <a href="https://api.whatsapp.com/send?phone=5562992349820" target="_blank" class="social-icon whatsapp" aria-label="WhatsApp da Rede Livrego">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="https://www.instagram.com/redelivrego/" target="_blank" class="social-icon instagram" aria-label="Instagram da Rede Livrego">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://www.youtube.com/@redelivrego" target="_blank" class="social-icon youtube" aria-label="YouTube da Rede Livrego">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>

                        {{-- 3 cards interativos --}}
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100" style="background-color: #156DAF;">
                                    <div class="card-body text-center" style="color: white;">
                                        <h5 class="card-title">
                                            <i class="fas fa-dice me-1"></i> Número da Sorte
                                        </h5>
                                        <p class="card-text">você poderá ser o próximo felizardo.</p>


@if ($numero)
  <div class="mt-2">
    <button type="button" class="btn btn-success btn-sm">
      {{ $numero->numero }}
    </button>
  </div>
@endif
                       
                                     <div id="resultadoWrapper" class="mt-2">
  <a href="#" class="btn btn-sm" style="background-color: white; color: #156DAF; border: none;" onclick="gerarNumeroDaSorte()">
    Gerar Número da Sorte</a></div>

                                    </div>
                                </div>
								
							<!-- Modal numero da sorte-->
<div class="modal fade" id="numeroModal" tabindex="-1" aria-labelledby="numeroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: linear-gradient(145deg, #156DAF, #0f4e7f); color: white; border-radius: 12px;">
      
      <div class="modal-header border-0 justify-content-center">
        <h5 class="modal-title fw-bold" id="numeroModalLabel">🎲 Seu Número da Sorte</h5>
      </div>

      <div class="modal-body text-center">
        <p class="fs-2 mb-2 fw-bold" id="numeroGerado">---</p>
        <p class="mb-1">Aguarde o sorteio e boa sorte! 🍀</p>
        <p class="mb-0 text-white" id="mensagemSorteio">Próximo sorteio: <strong>--/--/----</strong></p>
      </div>
      
      <div class="modal-footer justify-content-center border-0">
        <button type="button" class="btn btn-light text-primary fw-bold px-4" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>

    </div>
  </div>
</div>

<!-- fim Modal numero da sorte-->

<!-- Modal aviso-->

<div class="modal fade" id="modalJaTemNumero" tabindex="-1" aria-labelledby="modalJaTemNumeroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-danger" style="background-color: #e9e9e9; border-radius: 12px;">

      <div class="modal-header border-0 justify-content-center">
        <h5 class="modal-title fw-bold text-danger" id="modalJaTemNumeroLabel">⚠️ Atenção</h5>
      </div>

      <div class="modal-body text-center">
        <p class="fs-5 fw-bold text-danger">Você já tem um número da sorte.</p>
        <p class="fs-4 fw-bold text-dark" id="numeroExistenteModal">---</p>
      </div>

      <div class="modal-footer justify-content-center border-0">
        <button type="button" class="btn btn-outline-danger px-4 fw-bold" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>

    </div>
  </div>
</div>

<!-- fim Modal aviso-->
								
								
                            </div>
							
							
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100" style="background-color: #156DAF;">
                                    <div class="card-body text-center" style="color: white;">
                                        <h5 class="card-title">
                                            <i class="fas fa-tv me-1"></i> TV ao Vivo
                                        </h5>
                                        <p class="card-text">
                                            Assista 
                                            <span class="numero-destaque btn btn-sm" style="background-color: white; color: #156DAF;">{{ $totalCanais }}</span> canais <br> de tv ao vivo.
                                        </p>
                                        <a href="{{ route('canais.index') }}" class="btn btn-sm" style="background-color: white; color: #156DAF; border: none;">Assistir</a>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            <!-- Card "Comunidade" sem modal -->
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100" style="background-color: #156DAF;">
                                    <div class="card-body text-center" style="color: white;">
                                        <h5 class="card-title">
                                            <i class="fas fa-users me-1"></i> Comunidade
                                        </h5>
                                        <p class="card-text">Aqui você testa seus conhecimentos sobre futebol e ainda pode ganhar premios.</p>
                                        <!-- Botão sem ação de modal -->
                                        <a href="#" 
   class="btn btn-sm" 
   style="background-color: white; color: #156DAF; border: none;" 
   data-bs-toggle="modal" 
   data-bs-target="#matchPredictionModal">
   Conhecer
</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- card-body --}}
                </div> {{-- card --}}
            </div> {{-- col-md-8 --}}
        </div> {{-- row --}}
		
		<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Modal -->


<!-- Modal de Palpites -->
<div class="modal fade" id="matchPredictionModal" tabindex="-1" aria-labelledby="matchPredictionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      @if($rodada)
        <form method="POST" action="{{ route('rodadas.salvarPalpites', ['rodada' => $rodada->id]) }}">
          @csrf
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="matchPredictionModalLabel">
              📝 Palpites da Rodada: {{ $rodada->titulo }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body bg-light">
            @forelse ($rodada->jogos as $jogo)
              <div class="d-flex justify-content-between align-items-center p-2 my-2 bg-white rounded shadow-sm border">
                <strong class="text-end" style="width: 35%;">{{ $jogo->time_a }}</strong>

                <div class="d-flex justify-content-center gap-4" style="width: 25%;">
                  <input type="radio" name="palpites[{{ $jogo->id }}]" value="A" required title="Vitória Time A">
                  <input type="radio" name="palpites[{{ $jogo->id }}]" value="E" title="Empate">
                  <input type="radio" name="palpites[{{ $jogo->id }}]" value="B" title="Vitória Time B">
                </div>

                <strong class="text-start" style="width: 35%;">{{ $jogo->time_b }}</strong>
              </div>
            @empty
              <p class="text-muted">Nenhum jogo disponível nesta rodada.</p>
            @endforelse
          </div>

          <div class="modal-footer flex-column align-items-start gap-3 bg-white border-top">
            <div>
              <input type="checkbox" id="acceptTerms" />
              <label for="acceptTerms">
                <a href="{{ url('termo-participacao') }}" target="_blank" class="text-primary text-decoration-underline">
                  Aceito o termo de participação
                </a>
              </label>
            </div>

            <div class="w-100 d-flex justify-content-end gap-2">
              <button type="button" class="btn btn-outline-danger" id="clearPredictions">Limpar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary" id="submitPredictions" disabled>Salvar Palpites</button>
            </div>
          </div>
        </form>
      @else
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="matchPredictionModalLabel">Nenhuma rodada disponível</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted">Não há rodada ativa no momento para receber palpites.</p>
        </div>
        <div class="modal-footer bg-white d-flex justify-content-end">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      @endif

    </div>
  </div>
</div>



@section('scripts')


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('acceptTerms');
    const submitBtn = document.getElementById('submitPredictions');
    const clearBtn = document.getElementById('clearPredictions');

    checkbox.addEventListener('change', () => {
      submitBtn.disabled = !checkbox.checked;
    });

    clearBtn.addEventListener('click', () => {
      document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.checked = false;
      });
      submitBtn.disabled = true;
      checkbox.checked = false;
    });
  });
</script>



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    window.bootstrap = bootstrap; // Garante acesso global

    window.gerarNumeroDaSorte = function() {
      fetch("{{ route('numero.gerar') }}")
        .then(response => response.json())
        .then(data => {
          if (data.numero && !data.erro) {
            document.getElementById('resultadoWrapper').innerHTML = `
              <button type="button" class="btn btn-success btn-sm">${data.numero}</button>
            `;
            document.getElementById('numeroGerado').innerText = data.numero;

            if (data.proximo_sorteio) {
              document.getElementById('mensagemSorteio').innerHTML =
                `Próximo sorteio: <strong>${data.proximo_sorteio}</strong>`;
            }

            new bootstrap.Modal(document.getElementById('numeroModal')).show();

          } else if (data.erro && data.numero) {
            document.getElementById('numeroExistenteModal').innerText = data.numero;
            new bootstrap.Modal(document.getElementById('modalJaTemNumero')).show();

          } else if (data.erro) {
            document.getElementById('resultadoWrapper').innerHTML = `
              <p class="text-warning fw-bold">${data.erro}</p>
            `;
          }
        })
        .catch(error => {
          console.error('Erro ao gerar número da sorte:', error);
          document.getElementById('resultadoWrapper').innerHTML = `
            <p class="text-danger">Erro inesperado. Tente novamente.</p>
          `;
        });
    };
  });
</script>
@endpush




@endsection








		<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
		
    </div> {{-- container --}}

    {{-- Estilo dos ícones sociais e demais ajustes --}}
    <style>
        .faixa-topo {
            background-color: #156DAF;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
            padding: 10px 15px;
        }

        .faixa-topo p {
            color: #ffffff !important;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0;
            text-align: center;
        }

        /* Ícones sociais coloridos */
        .social-icon {
            font-size: 2rem;
            transition: color 0.3s ease;
        }

        .social-icon.whatsapp {
            color: #25D366; /* verde WhatsApp */
        }

        .social-icon.instagram {
            color: #E4405F; /* rosa Instagram */
        }

        .social-icon.youtube {
            color: #FF0000; /* vermelho YouTube */
        }

        .social-icon:hover {
            filter: brightness(1.2);
            text-decoration: none;
        }

        .btn-social {
            border: 1px solid #003366;
            color: #003366;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-social:hover {
            background-color: #003366;
            color: #fff;
        }

        .btn-social i {
            margin-right: 5px;
        }

        .numero-destaque {
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
@endsection
