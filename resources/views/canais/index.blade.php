@extends('layouts.app')

@section('content')
<!-- Menu superior com rolagem horizontal -->
<div class="py-2 border-bottom" style="background-color: #156daf;">
    <div class="container">
        <div class="overflow-auto">
            <ul class="nav flex-nowrap text-nowrap">
                <li class="nav-item"><a class="nav-link text-white px-3" href="{{ url('canais/') }}">INÍCIO</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">CATEGORIAS</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="#">COMO ASSISTIR</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="{{ route('responsabilidade') }}">TERMO DE RESPONSABILIDADE</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3" href="{{ url('canais/create') }}">ADICIONAR CANAL</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @foreach ($canais as $canal)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('canais.show', $canal->id) }}" class="text-decoration-none text-dark">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 120px;">
                            <img src="{{ asset('storage/' . $canal->logo) }}" alt="{{ $canal->nome }}" class="img-fluid" style="max-height: 80px;">
                        </div>
                        <div class="card-body" style="background-color: #156DAF; color: #fff;">
                            <h5 class="card-title">{{ $canal->nome }}</h5>
                            @if(isset($canal->cidade) && isset($canal->estado))
                                <p class="card-text mb-1">
                                    <small>{{ $canal->cidade }} / {{ $canal->estado }}</small>
                                </p>
                            @elseif($canal->localizacao)
                                <p class="card-text mb-1">
                                    <small>{{ $canal->localizacao }}</small>
                                </p>
                            @endif
                            {{-- Trecho removido:
                            @if(isset($canal->responsavel))
                                <p class="card-text mb-0">
                                    <small>Responsável: {{ $canal->responsavel }}</small>
                                </p>
                            @endif
                            --}}
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
