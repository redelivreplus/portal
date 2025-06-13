@extends('layouts.app')

@section('title', 'Canais Web TV Ao Vivo')

@section('content')

<!-- Menu superior com rolagem horizontal -->
<div class="py-2 border-bottom" style="background-color: #555;">
    <div class="container">
        <div class="overflow-auto">
            <ul class="nav flex-nowrap text-nowrap">
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">INÍCIO</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">CATEGORIAS</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">COMO ASSISTIR</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">POLÍTICA DE PRIVACIDADE</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="{{ url('canais/create') }}">ADICIONAR CANAL</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Conteúdo principal -->
<div class="container py-4">
    <div class="row g-4">

  


        {{-- Caso não haja canais --}}
        @if ($canais->isEmpty())
            <div class="col-12 text-center text-muted">
                Nenhum canal disponível no momento.
            </div>
        @endif

    </div>
</div>

@endsection
