@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">
            <i class="fas fa-tv me-2"></i>Rede Livre TV
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                
                <div class="card-body bg-black p-0">
                    <div class="ratio ratio-16x9">
                        <video
                            id="tvPlayer"
                            class="w-100"
                            muted
                            controls
                            autoplay
                            playsinline
                        ></video>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    Apenas assinantes têm acesso a todos os canais. <a href="#" class="btn btn-outline-primary btn-sm">Seja VIP</a>
                </p>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/hls.js@1.5.8/dist/hls.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("tvPlayer");
            const videoSrc = "https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8";

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
                console.error("Seu navegador não suporta reprodução de vídeo ao vivo.");
            }
        });
    </script>
@endsection
