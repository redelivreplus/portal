@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                {{-- Card com faixa azul no topo --}}
                <div class="card shadow-sm border-0">

                    {{-- Faixa azul com título --}}
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Termo de Participação</h5>
                    </div>

                    {{-- Corpo do card com fundo cinza claro --}}
                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">

                        <p class="mb-4">
                            Ao participar das rodadas de palpites deste site, o usuário concorda com os termos aqui estabelecidos. O participante que obtiver o maior número de acertos na rodada será declarado vencedor.
                        </p>

                        <p class="mb-4">
                            Em caso de empate entre dois ou mais participantes com o mesmo número de acertos, o prêmio será <strong>dividido igualmente</strong> entre os vencedores.
                        </p>

                        <p class="mb-4">
                            O participante autoriza, de forma irrevogável e irretratável, o uso gratuito de sua <strong>imagem, nome e voz</strong> em peças de divulgação relacionadas à premiação, nas redes sociais e canais da plataforma, sem qualquer tipo de remuneração adicional.
                        </p>

                        <p class="mb-4">
                            Os palpites têm caráter exclusivamente <strong>interativo e recreativo</strong>, com o objetivo de engajar os usuários e promover a participação na plataforma.
                        </p>

                        <p class="mb-4">
                            Os prêmios oferecidos podem incluir <strong>vales-brindes, camisetas, bonés</strong> ou <strong>transferência via PIX</strong>, sendo sempre entregues exclusivamente na conta bancária vinculada ao <strong>nome completo cadastrado</strong> no sistema do site.
                        </p>

                        <p class="mb-4">
                            Quando o prêmio for único e houver empate, o critério de desempate poderá incluir: <strong>data e hora do envio do palpite</strong>, número de rodadas anteriores participadas ou outro critério justo previamente informado pela organização.
                        </p>

                        <p class="mb-4">
                            Ao clicar no botão "Aceito os Termos" e submeter o seu palpite, o usuário declara estar ciente e concordar integralmente com os termos acima.
                        </p>

                        <p class="text-muted text-end">
                            Última atualização: 8 de junho de 2025
                        </p>

                        {{-- Botão para fechar/voltar --}}
                        <div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="window.close()">Fechar</button>
</div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
