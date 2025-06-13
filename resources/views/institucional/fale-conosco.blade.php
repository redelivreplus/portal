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
                        <h5 class="mb-0">Fale Conosco</h5>
                    </div>

                    {{-- Corpo do card com fundo cinza claro --}}
                    <div class="card-body" style="background-color: #e9e9e9; color: #000; font-size: 1.05rem;">
                        
                        {{-- Informações de contato --}}
                        <p class="mb-3">
                            <strong>Telefone:</strong> (62) 99366-4882<br>
                            <strong>WhatsApp:</strong> (62) 99234-8240<br>
                            <strong>E-mail:</strong> <a href="mailto:contato@redelivre.tv.br">contato@redelivre.tv.br</a>
                        </p>

                        <hr class="my-4">

                        {{-- Formulário de contato --}}
                        <form method="POST" action="{{ route('faleconosco.enviar') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="background-color: #156DAF;">Enviar Mensagem</button>
                        </form>

                        {{-- Mensagem de sucesso --}}
                        @if(session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
