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
                        <h5 class="mb-0">Sobre Nós</h5>
                    </div>

                    {{-- Corpo do card com fundo cinza claro --}}
                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">

                        <p class="mb-4">
                            A <strong>Rede Livre de Comunicação</strong> é uma iniciativa colaborativa e descentralizada que nasce do desejo de criar um espaço informativo livre, plural e comprometido com a transformação social.
                        </p>

                        <p class="mb-4">
                            Diferente dos grandes veículos comerciais, nossa proposta é colocar a comunicação a serviço das pessoas e dos territórios. Atuamos com base em princípios de <strong>autonomia, horizontalidade, transparência</strong> e <strong>diversidade de vozes</strong>, buscando construir uma mídia feita por e para quem quer se informar de forma crítica e participativa.
                        </p>

                        <p class="mb-4">
                            Valorizamos o que pulsa nos bairros, periferias e comunidades. Temos um olhar atento ao <strong>esporte amador</strong>, com ênfase no <strong>futebol de várzea</strong>, que movimenta multidões e fortalece vínculos locais. Damos espaço também a <strong>cantores e artistas em início de carreira</strong>, à <strong>cultura popular</strong>, às <strong>manifestações tradicionais</strong> e ao <strong>comércio local</strong>, fundamentais para a vida econômica e cultural das cidades.
                        </p>

                        <p class="mb-4">
                            Utilizamos tecnologias livres, redes comunitárias e plataformas de código aberto para garantir que a informação circule sem censura ou controle centralizado. Estamos presentes em meios digitais, rádios comunitárias, coletivos audiovisuais e movimentos sociais, conectando experiências locais em uma rede viva e em constante construção.
                        </p>

                        <p class="mb-4">
                            Nossa missão é <strong>promover o acesso à comunicação como um direito fundamental</strong>, fortalecer a democracia de base e construir pontes entre comunidades, culturas e saberes. Aqui, cada voz importa e cada narrativa é parte da construção do bem comum.
                        </p>

                        <p class="mb-4">
                            Na Rede Livre, acreditamos que <strong>comunicar é um ato político e coletivo</strong>. E fazemos isso com escuta, compromisso e liberdade.
                        </p>

                        <p class="mb-4 font-italic">
                            Rede Livre – Comunicação que conecta, transforma e liberta.
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
