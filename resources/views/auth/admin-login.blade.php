<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #0d6efd; /* Azul bonito */
        }

        .login-card {
            background-color: #f8f9fa; /* Cor suave para contraste */
            border-radius: 1rem;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card login-card border-0 p-4">
            <div class="text-center mb-3">
                {{-- Logo (opcional) --}}
                <img src="{{ asset('images/logo-admin.png') }}" alt="Logo Admin" style="height: 50px;" class="mb-2">
                <h4 class="card-title">Acesso Administrativo</h4>
            </div>

            {{-- Feedback de erro --}}
            @if(session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
            @endif

            {{-- Formulário --}}
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="Digite seu e-mail"
                           required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Digite sua senha"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
