@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">

                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center" style="background-color: #156DAF;">
                        <h5 class="mb-0">Cadastro de Usuário</h5>
                    </div>

                    <div class="card-body" style="background-color: #f1f1f1;">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('cadastro.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Nome Completo</label>
                                    <input name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Usuário</label>
                                    <input name="username" class="form-control" value="{{ old('username') }}" required>
                                </div>

                                <div class="col-md-2">
                                    <label>Imagem de Perfil</label>
                                    <input type="file" name="profile_image" class="form-control">
                                </div>

                                <div class="col-md-5">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Data de Nascimento</label>
                                    <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}">
                                </div>

                                <div class="col-md-2">
                                    <label>Senha</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="col-md-2">
                                    <label>Confirmar Senha</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <input id="cep" name="cep" class="form-control" maxlength="9" value="{{ old('cep') }}">
                                        <button class="btn btn-outline-secondary" type="button" id="buscar-cep">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label>Endereço</label>
                                    <input name="address" id="logradouro" class="form-control" value="{{ old('address') }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Complemento</label>
                                    <input name="complement" class="form-control" value="{{ old('complement') }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Bairro</label>
                                    <input name="neighborhood" id="bairro" class="form-control" value="{{ old('neighborhood') }}">
                                </div>

                                <div class="col-md-5">
                                    <label>Cidade</label>
                                    <input name="city" id="cidade" class="form-control" value="{{ old('city') }}" required>
                                </div>

                                <div class="col-md-1">
                                    <label>(UF)</label>
                                    <input name="state" id="uf" class="form-control" maxlength="2" value="{{ old('state') }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Telefone</label>
                                    <input name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>

                                <div class="col-md-3">
                                    <label>WhatsApp</label>
                                    <input name="whatsapp" class="form-control" value="{{ old('whatsapp') }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Instagram</label>
                                    <input name="instagram_profile_url" class="form-control" value="{{ old('instagram_profile_url') }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Facebook</label>
                                    <input name="facebook_profile_url" class="form-control" value="{{ old('facebook_profile_url') }}">
                                </div>

                                <div class="col-md-6">
                                    <label>YouTube</label>
                                    <input name="youtube_profile_url" class="form-control" value="{{ old('youtube_profile_url') }}">
                                </div>

                                <div class="col-md-6">
                                    <label>Interesses</label>
                                    <textarea name="interests" class="form-control">{{ old('interests') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label>Biografia</label>
                                    <textarea name="bio" class="form-control">{{ old('bio') }}</textarea>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="show_bio" id="show_bio" {{ old('show_bio') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_bio">Exibir biografia</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="show_interests" id="show_interests" {{ old('show_interests') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_interests">Exibir interesses</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
    <button type="submit" class="btn px-4" style="background-color: #555; color: white; border: none;">
        Cadastrar
    </button>
</div>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none">Já tem conta? Faça login</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('cep');
    const buscarBtn = document.getElementById('buscar-cep');

    // Ao digitar no campo
    cepInput.addEventListener('input', function () {
        const rawCep = cepInput.value.replace(/\D/g, '');
        if (rawCep.length === 8) buscarCep(rawCep);
    });

    // Ao clicar no botão
    buscarBtn.addEventListener('click', function () {
        const rawCep = cepInput.value.replace(/\D/g, '');
        if (rawCep.length === 8) buscarCep(rawCep);
        else alert('Digite um CEP válido com 8 dígitos.');
    });

    async function buscarCep(cep) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);

            const data = await response.json();
            if (data.erro) {
                alert('CEP não encontrado.');
            } else {
                document.getElementById('logradouro').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('cidade').value = data.localidade || '';
                document.getElementById('uf').value = data.uf || '';
            }
        } catch (error) {
            console.error('Erro ao buscar o CEP:', error);
            alert('Erro ao buscar o CEP. Verifique sua conexão e tente novamente.');
        }
    }
});
</script>
@endpush

@endpush
