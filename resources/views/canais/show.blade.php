@extends('layouts.app')

@section('content')
<div class="container py-1">

    {{-- Área com logo, título e botões de navegação --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        {{-- Logo da emissora --}}
        <div class="me-3 mb-3">
            <img src="{{ asset('storage/' . $canal->logo) }}"
                 alt="Logo da emissora {{ $canal->nome }}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height: 100px; max-width: 180px;">
        </div>

        {{-- Informações e navegação --}}
        <div class="flex-grow-1">
            {{-- Título e localização --}}
            <div class="mb-2 text-center text-md-start">
                <h2 class="fw-bold mb-1 text-secondary">{{ $canal->nome }}</h2>
                <div class="d-flex flex-wrap gap-3 text-dark fs-6">
                    <div><strong>Cidade:</strong> {{ $canal->cidade ?? 'Desconhecida' }}</div>
                    <div><strong>UF:</strong> {{ $canal->estado ?? 'Desconhecido' }}</div>
                </div>
            </div>

            {{-- Botões de navegação --}}
            <div class="d-flex flex-wrap gap-2 justify-content-md-start justify-content-center mt-2">
                @isset($prevCanal)
                    <a href="{{ route('canais.show', $prevCanal->id) }}" class="btn btn-custom-blue px-4 py-2">← Anterior</a>
                @else
                    <button class="btn btn-custom-blue px-4 py-2" disabled>← Anterior</button>
                @endisset

                <a href="{{ route('canais.index') }}" class="btn btn-custom-blue px-4 py-2">🏠 Início</a>

                @isset($nextCanal)
                    <a href="{{ route('canais.show', $nextCanal->id) }}" class="btn btn-custom-blue px-4 py-2">Próximo →</a>
                @else
                    <button class="btn btn-custom-blue px-4 py-2" disabled>Próximo →</button>
                @endisset
            </div>

        </div>
    </div>

    {{-- Player de vídeo --}}
    <div class="card shadow border-0 bg-black">
        <div class="card-body p-0">
            <div class="ratio ratio-16x9">
                <video id="tvPlayer" class="w-100" muted controls autoplay playsinline></video>
            </div>

            {{-- Aviso de responsabilidade --}}
            <div class="text-center responsibility-note py-3 bg-dark border-top border-secondary">
                Todos os créditos e direitos pelos conteúdos exibidos são de responsabilidade da emissora <strong>{{ $canal->nome }}</strong>.
            </div>
        </div>
    </div>

</div>
@endsection

@section('styles')
<style>
    /* Estilo customizado para os botões */
    .btn-custom-blue {
        border: 2px solid #156DAF; /* Borda azul */
        color: #156DAF; /* Texto azul */
        background-color: transparent; /* Fundo transparente */
        border-radius: 50px; /* Bordas arredondadas */
        transition: all 0.3s ease; /* Transição suave */
    }

    /* Efeito quando o botão é hover (passa o mouse por cima) */
    .btn-custom-blue:hover:not(:disabled) {
        background-color: #156DAF; /* Fundo azul */
        color: white; /* Texto branco */
        text-decoration: none; /* Sem sublinhado */
    }

    /* Estilo para o botão desabilitado */
    .btn-custom-blue:disabled {
        opacity: 0.5; /* Opacidade reduzida */
        cursor: not-allowed; /* Cursor em forma de bloqueio */
        border: 2px solid #aaa; /* Borda mais clara */
        color: #aaa; /* Texto mais claro */
        background-color: transparent; /* Fundo transparente */
    }

    .responsibility-note {
        font-style: italic;
        font-size: 0.875rem;
        color: #ccc;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/hls.js@1.5.8/dist/hls.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById("tvPlayer");
        const videoSrc = @json($canal->url);

        if (Hls.isSupported()) {
            const hls = new Hls();
            hls.loadSource(videoSrc);
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED, function () {
                video.play();
            });
        } else if (video.canPlayType("application/vnd.apple.mpegurl")) {
            video.src = videoSrc;
            video.play();
        } else {
            console.error("Seu navegador não suporta HLS.");
        }
    });
</script>
@endsection
