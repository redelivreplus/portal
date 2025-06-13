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
                        <h5 class="mb-0">Termos de Uso</h5>
                    </div>

                    {{-- Corpo do card em cinza claro --}}
                    <div class="card-body" style="background-color: #e9e9e9; color: #000;">

                        <p class="mb-4">
                            Bem-vindo(a) ao portal <strong>Rede Livre</strong>. Esta página apresenta os termos e condições que regem o uso de nossos serviços. Ao navegar, utilizar recursos ou realizar qualquer tipo de interação no site, você concorda expressamente com todas as cláusulas abaixo. Leia com atenção.
                        </p>

                        <h4 class="mt-4">1. Acesso e Navegação</h4>
                        <p>
                            O acesso ao conteúdo informativo do Rede Livre é livre e gratuito. Não exigimos cadastro para a navegação básica. No entanto, determinadas funcionalidades exclusivas — como palpites em jogos, acesso a canais de TV ao vivo, rádios e conteúdos personalizados — são disponibilizadas somente para usuários cadastrados.
                        </p>
                        <p>
                            O cadastro é gratuito e realizado com dados mínimos, respeitando nossa <a href="{{ route('privacidade') }}">Política de Privacidade</a>.
                        </p>

                        <h4 class="mt-4">2. Responsabilidades do Usuário</h4>
                        <p>
                            O usuário compromete-se a utilizar o portal de forma ética e legal, abstendo-se de publicar, compartilhar ou transmitir conteúdos que:
                        </p>
                        <ul>
                            <li>violem direitos autorais, privacidade ou propriedade intelectual de terceiros;</li>
                            <li>promovam discurso de ódio, discriminação ou incitação à violência;</li>
                            <li>contenham material ofensivo, ilegal ou inapropriado.</li>
                        </ul>
                        <p>
                            Comentários e palpites publicados são de responsabilidade exclusiva dos usuários. O Rede Livre se reserva o direito de remover conteúdos que infrinjam estes termos, sem aviso prévio.
                        </p>

                        <h4 class="mt-4">3. Direitos Autorais e Propriedade Intelectual</h4>
                        <p>
                            Todo o conteúdo presente no portal — incluindo textos, imagens, gráficos, logotipos, vídeos e códigos — é protegido por leis de direitos autorais e pertence ao Rede Livre ou a terceiros licenciados. É proibida a reprodução, modificação ou redistribuição sem autorização expressa.
                        </p>

                        <h4 class="mt-4">4. Conteúdo de Terceiros</h4>
                        <p>
                            O portal pode apresentar conteúdos gerados por parceiros ou incorporados de terceiros. Esses materiais são de responsabilidade de seus respectivos autores. O Rede Livre pode remover qualquer conteúdo que viole nossas diretrizes ou a legislação vigente.
                        </p>

                        <h4 class="mt-4">5. Privacidade dos Dados</h4>
                        <p>
                            Prezamos pela segurança e privacidade dos dados dos nossos usuários. Informações coletadas durante o uso do portal ou no processo de cadastro são utilizadas exclusivamente para oferecer uma experiência personalizada e segura.
                        </p>
                        <p>
                            Para mais detalhes sobre a coleta, uso e proteção de informações, consulte nossa <a href="{{ route('privacidade') }}">Política de Privacidade</a>.
                        </p>

                        <h4 class="mt-4">6. Alterações nos Termos</h4>
                        <p>
                            O Rede Livre poderá atualizar este documento a qualquer momento, visando o aprimoramento dos serviços ou adequações legais. Recomendamos que você consulte esta página periodicamente para estar sempre informado.
                        </p>

                        <h4 class="mt-4">7. Suspensão de Acesso</h4>
                        <p>
                            Reservamo-nos o direito de suspender ou cancelar o acesso de usuários que violem estes Termos de Uso, sem a necessidade de aviso prévio. A reincidência poderá acarretar bloqueio definitivo.
                        </p>

                        <h4 class="mt-4">8. Isenção de Responsabilidade</h4>
                        <p>
                            O Rede Livre não se responsabiliza por danos decorrentes do uso inadequado da plataforma ou por conteúdos publicados por terceiros. Também não garantimos disponibilidade contínua ou isenta de falhas, embora nos esforcemos constantemente por manter o portal estável e seguro.
                        </p>

                        <h4 class="mt-4">9. Jurisdição e Foro</h4>
                        <p>
                            Estes termos são regidos pelas leis da República Federativa do Brasil. Fica eleito o foro da comarca de domicílio do usuário ou, na ausência deste, o da cidade sede da Rede Livre para dirimir eventuais conflitos.
                        </p>

                        <h4 class="mt-4">10. Contato</h4>
                        <p>
                            Em caso de dúvidas, sugestões ou solicitações sobre estes Termos de Uso, entre em contato conosco:
                        </p>
                        <ul>
                            <li><strong>E-mail:</strong> contato@redelivre.com.br</li>
                        </ul>

                        <p class="mt-5"><em>Última atualização: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</em></p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
