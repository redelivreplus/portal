@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Nova Senha</h5>
                    </div>

                    <div class="card-body" style="background-color: #f1f1f1;">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                            <div class="form-group mb-3">
                                <label for="password">Nova Senha</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required>

                                @error('password')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-confirm">Confirme a Senha</label>
                                <input type="password" name="password_confirmation" id="password-confirm"
                                    class="form-control" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="width: 70%;">
                                    Redefinir Senha
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
