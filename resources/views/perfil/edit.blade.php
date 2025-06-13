@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">

                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Editar Perfil</h5>
                    </div>

                    {{-- Faixa Azul com Notificação --}}
                    <div class="faixa-topo">
                        <p>
                            🎯 <strong>Rei do Palpite</strong> cravou o resultado &nbsp;&nbsp;•&nbsp;&nbsp;
                            ✅ <strong>Bom de Palpite</strong> acertou o vencedor/empate &nbsp;&nbsp;•&nbsp;&nbsp;
                            ❌ <strong>Pé Frio</strong> errou tudo
                        </p>
                    </div>

                    <div class="card-body" style="background-color: #f1f1f1;">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('perfil.update', $user->profile_slug) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name">Nome Completo</label>
                                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="username">Usuário</label>
                                    <input id="username" name="username" type="text" class="form-control" value="{{ old('username', $user->username) }}" required>
                                </div>

                                <div class="col-md-2">
                                    <label for="profile_image">Imagem de Perfil</label>
                                    <input id="profile_image" name="profile_image" type="file" class="form-control">
                                    @if($user->profile_image_url)
                                        <small>Imagem atual: 
                                            <a href="{{ asset('storage/' . $user->profile_image_url) }}" target="_blank" rel="noopener noreferrer">Ver imagem</a>
                                        </small>
                                    @endif
                                </div>

                                <div class="col-md-5">
                                    <label for="email">E-mail</label>
                                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="birth_date">Data de Nascimento</label>
                                    <input id="birth_date" name="birth_date" type="date" class="form-control" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="password">Nova Senha</label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Deixe em branco para manter">
                                </div>

                                <div class="col-md-2">
                                    <label for="password_confirmation">Confirmar Senha</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Deixe em branco para manter">
                                </div>

                                <div class="col-md-5">
                                    <label for="address">Endereço</label>
                                    <input id="address" name="address" type="text" class="form-control" value="{{ old('address', $user->address) }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="neighborhood">Bairro</label>
                                    <input id="neighborhood" name="neighborhood" type="text" class="form-control" value="{{ old('neighborhood', $user->neighborhood) }}">
                                </div>

                                <div class="col-md-5">
                                    <label for="city">Cidade</label>
                                    <input id="city" name="city" type="text" class="form-control" value="{{ old('city', $user->city) }}">
                                </div>

                                <div class="col-md-1">
                                    <label for="state">(UF)</label>
                                    <input id="state" name="state" type="text" maxlength="2" class="form-control" value="{{ old('state', $user->state) }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="phone">Telefone</label>
                                    <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="whatsapp">WhatsApp</label>
                                    <input id="whatsapp" name="whatsapp" type="text" class="form-control" value="{{ old('whatsapp', $user->whatsapp) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="instagram_profile_url">Instagram</label>
                                    <input id="instagram_profile_url" name="instagram_profile_url" type="url" class="form-control" value="{{ old('instagram_profile_url', $user->instagram_profile_url) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="facebook_profile_url">Facebook</label>
                                    <input id="facebook_profile_url" name="facebook_profile_url" type="url" class="form-control" value="{{ old('facebook_profile_url', $user->facebook_profile_url) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="youtube_profile_url">YouTube</label>
                                    <input id="youtube_profile_url" name="youtube_profile_url" type="url" class="form-control" value="{{ old('youtube_profile_url', $user->youtube_profile_url) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="interests">Interesses</label>
                                    <textarea id="interests" name="interests" class="form-control" rows="3">{{ old('interests', $user->interests) }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="bio">Biografia</label>
                                    <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="show_bio" id="show_bio" {{ old('show_bio', $user->show_bio) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_bio">Exibir biografia</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="show_interests" id="show_interests" {{ old('show_interests', $user->show_interests) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_interests">Exibir interesses</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary px-4">Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Estilo da Faixa Azul --}}
<style>
    .faixa-topo {
        background-color: #156DAF;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        color: white;
        padding: 10px;
        text-align: center;
    }

    .faixa-topo p {
        margin: 0;
        font-size: 16px;
    }

    .faixa-topo strong {
        color: #FFD700;
    }
</style>
@endsection
