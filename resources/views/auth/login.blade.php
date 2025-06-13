@extends('layouts.app')

@section('content')
<style>
    /* Botão criar conta com contorno e texto azul #156DAF */
    .btn-outline-secondary {
        color: #156DAF;
        border-color: #156DAF;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    /* Hover para o botão criar conta */
    .btn-outline-secondary:hover {
        background-color: #156DAF !important;
        color: #fff !important;
        border-color: #156DAF !important;
    }
</style>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="card shadow-sm border-0">
                    {{-- Cabeçalho azul personalizado --}}
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Acesso ao Sistema</h5>
                    </div>

                    {{-- Corpo do card cinza claro --}}
                    <div class="card-body" style="background-color: #f1f1f1;">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Campo E-mail --}}
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Campo Senha --}}
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Lembrar-me --}}
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                       name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Lembrar-me
                                </label>
                            </div>

                            {{-- Botão --}}
                            <div class="text-center">
                                <button type="submit" class="btn" style="width: 40%; background-color: #156DAF; color: white; border: none;">
                                    <i class="fas fa-sign-in-alt me-1"></i> Entrar
                                </button>
                            </div>

                        </form>

                        {{-- Link para recuperação de senha --}}
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="small text-decoration-none">
                                Esqueceu sua senha?
                            </a>
                        </div>

                        {{-- Link para cadastro com borda azul fixa --}}
                        <div class="text-center mt-2">
                            <span class="small">Ainda não tem uma conta?</span><br>
                            <a href="{{ route('cadastro.form') }}" class="btn btn-outline-secondary btn-sm mt-1">
                                Criar conta
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
