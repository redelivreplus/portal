@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                {{-- Faixa azul no topo --}}
                <div class="card shadow-sm border-0">

                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Termo de Responsabilidade</h5>
                    </div>

                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">

                        <p>
                            Ao cadastrar um canal na plataforma <strong>Rede Livre</strong>, o usuário declara, sob total responsabilidade,
                            que leu, compreendeu e concorda com os termos descritos abaixo.
                        </p>

                        <h5>1. Responsabilidade do Cadastro</h5>
                        <p>
                            O canal está sendo cadastrado por um responsável legal, representante, proprietário ou pessoa autorizada. 
                            O usuário declara que possui todos os direitos legais ou permissão necessária para disponibilizar o conteúdo.
                        </p>

                        <h5>2. Direitos de Reprodução</h5>
                        <p>
                            O usuário autoriza expressamente a plataforma <strong>Rede Livre</strong> a reproduzir o canal cadastrado 
                            exclusivamente em seu domínio oficial (<a href="https://redelivre.tv.br" target="_blank">redelivre.tv.br</a>) 
                            por meio de player integrado, utilizando o link de transmissão fornecido no ato do cadastro.
                        </p>

                        <h5>3. Sobre os Canais Públicos</h5>
                        <p>
                            A <strong>Rede Livre</strong> também atua como um agregador de canais públicos e oficiais, com transmissão via links disponibilizados publicamente por emissoras ou órgãos governamentais.
                        </p>
                        <p>
                            Canais como <strong>TV Câmara, TV Senado, TV Justiça, TV Brasil, TV Cultura, TV Assembleia</strong> e similares são de caráter público ou educativo, com veiculação gratuita e aberta. 
                            Estes canais são exibidos sem alterações e sem qualquer exploração comercial por parte da Rede Livre.
                        </p>
                        <ul>
                            <li>✅ Não alteramos o conteúdo original.</li>
                            <li>✅ Os direitos autorais pertencem integralmente às respectivas emissoras.</li>
                        </ul>

                        <h5>4. Conteúdo Permitido</h5>
                        <p>O usuário se compromete a cadastrar apenas canais que:</p>
                        <ul>
                            <li>Não infrinjam direitos autorais ou propriedade intelectual de terceiros;</li>
                            <li>Não veiculem conteúdo ilegal, ofensivo ou contrário à legislação brasileira;</li>
                            <li>Não promovam discurso de ódio, discriminação, pornografia ou atividades ilícitas.</li>
                        </ul>

                        <h5>5. Moderação e Exclusividade</h5>
                        <p>
                            A <strong>Rede Livre</strong> se reserva o direito de:
                        </p>
                        <ul>
                            <li>Suspender, remover ou ocultar canais que estejam em desacordo com os termos;</li>
                            <li>Solicitar documentação que comprove autorização de uso e reprodução;</li>
                            <li>Recusar conteúdos que comprometam a imagem ou a proposta da plataforma.</li>
                        </ul>

                        <h5>6. Limitação de Responsabilidade</h5>
                        <p>
                            A <strong>Rede Livre</strong> atua como intermediária na disponibilização dos conteúdos. Toda responsabilidade pelo conteúdo, sua origem e autorização recai exclusivamente sobre o usuário que realiza o cadastro.
                        </p>

                        <h5>7. Retirada de Conteúdo</h5>
                        <p>
                            Caso você seja representante legal de alguma emissora e deseje <strong>reivindicar, atualizar ou remover</strong> um canal listado, entre em contato através do e-mail: 
                            <strong><a href="mailto:contato@redelivre.tv.br">contato@redelivre.tv.br</a></strong>. Atenderemos prontamente qualquer solicitação válida.
                        </p>

                        <h5>8. Aceite</h5>
                        <p>
                            O aceite deste termo é obrigatório para o envio do formulário de cadastro. 
                            Ao marcar a caixa de aceite e clicar em “Salvar Canal”, o usuário concorda com todos os pontos acima.
                        </p>

                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('canais.create') }}" class="btn" style="background-color: #156DAF; color: #fff; width: 200px;">
                                Voltar para Cadastro
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
