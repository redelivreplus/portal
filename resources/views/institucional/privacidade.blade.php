@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                {{-- Faixa azul no topo --}}
                <div class="card shadow-sm border-0">

                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Política de Privacidade</h5>
                    </div>

                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">

                        <p class="mb-4">
                            Esta Política de Privacidade tem como objetivo explicar de forma clara e transparente como a <strong>Rede Livre de Comunicação</strong> coleta, utiliza, armazena e protege os dados pessoais e as interações dos participantes em nossa plataforma.
                        </p>

                        <h4>1. Compromisso com a Privacidade</h4>
                        <p>
                            A Rede Livre valoriza a liberdade de expressão, a autonomia digital e a privacidade dos seus participantes. Dados pessoais são tratados com responsabilidade e apenas quando estritamente necessários para o funcionamento da plataforma e para a proteção da comunidade.
                        </p>

                        <h4>2. Coleta de Informações</h4>
                        <p>
                            Coletamos apenas as informações mínimas necessárias para garantir segurança, desempenho e acessibilidade do sistema. Isso pode incluir:
                        </p>
                        <ul>
                            <li>Nome ou pseudônimo</li>
                            <li>E-mail de contato</li>
                            <li>Endereço IP e dados técnicos do navegador (para segurança e análise de acesso)</li>
                        </ul>
                        <p>
                            Essas informações são coletadas com base no seu consentimento e são utilizadas exclusivamente para fins operacionais e comunitários.
                        </p>

                        <h4>3. Uso de Cookies</h4>
                        <p>
                            Utilizamos cookies essenciais para o funcionamento da plataforma (como manter sua sessão ativa), mas não rastreamos sua navegação nem coletamos dados para fins publicitários. Você pode configurar seu navegador para bloquear cookies, mas isso pode limitar algumas funcionalidades.
                        </p>

                        <h4>4. Compartilhamento de Dados</h4>
                        <p>
                            Não compartilhamos seus dados com terceiros, exceto quando:
                        </p>
                        <ul>
                            <li>For necessário para o funcionamento técnico da rede (ex.: servidores ou hospedagem segura)</li>
                            <li>Houver exigência legal por autoridade competente</li>
                            <li>Você autorizar expressamente</li>
                        </ul>

                        <h4>5. Conteúdo Gerado por Usuários</h4>
                        <p>
                            Ao publicar textos, imagens, áudios ou vídeos na Rede Livre, você continua sendo o autor e detentor dos direitos do conteúdo. No entanto, concede à Rede Livre uma licença gratuita e não exclusiva para exibir o material em nossos canais, sempre com os devidos créditos.
                        </p>
                        <p>
                            O conteúdo postado deve respeitar os princípios éticos da comunidade. Comentários ou publicações que violem direitos, incitem ódio, violência ou qualquer ilegalidade poderão ser removidos.
                        </p>

                        <h4>6. Segurança e Armazenamento</h4>
                        <p>
                            Os dados armazenados são protegidos por medidas técnicas e administrativas adequadas para garantir sua confidencialidade, integridade e disponibilidade. Trabalhamos com servidores seguros e tecnologias livres sempre que possível.
                        </p>

                        <h4>7. Seus Direitos</h4>
                        <p>
                            Você tem o direito de acessar, corrigir ou excluir seus dados pessoais a qualquer momento. Também pode solicitar informações sobre como seus dados estão sendo utilizados.
                        </p>

                        <h4>8. Atualizações desta Política</h4>
                        <p>
                            Esta Política de Privacidade pode ser modificada para refletir melhorias na plataforma, mudanças legais ou ajustes na nossa operação. Quaisquer alterações serão comunicadas com transparência.
                        </p>

                        <h4>9. Contato</h4>
                        <p>
                            Em caso de dúvidas, sugestões ou solicitações relacionadas à privacidade, entre em contato conosco pelo e-mail:  
                            <strong><a href="mailto:contato@redelivre.tv.br">contato@redelivre.tv.br</a></strong>
                        </p>

                        <p class="mt-4">
                            Última atualização: {{ date('d/m/Y') }}
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
