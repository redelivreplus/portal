<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('cadastro');
    }

    /**
     * Processa o envio do formulário de cadastro.
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            // Cria ou busca a cidade
            $city = City::firstOrCreate(
                [
                    'name' => $request->city,
                    'state' => strtoupper($request->state),
                ],
                [
                    'slug' => Str::slug($request->city . '-' . $request->state),
                ]
            );

            // Upload da imagem de perfil (se enviada)
            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            }

            // Cria o novo usuário
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'profile_slug' => Str::slug($request->username),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'address' => $request->address,
                'neighborhood' => $request->neighborhood,
                'fk_city_id' => $city->id,
                'state' => strtoupper($request->state),
                'bio' => $request->bio,
                'interests' => $request->interests,
                'facebook_profile_url' => $request->facebook_profile_url,
                'instagram_profile_url' => $request->instagram_profile_url,
                'twitter_profile_url' => $request->twitter_profile_url,
                'youtube_profile_url' => $request->youtube_profile_url,
                'show_bio' => $request->has('show_bio'),
                'show_interests' => $request->has('show_interests'),
                'profile_image_url' => $profileImagePath,
            ]);

            // Login automático após cadastro
            auth()->login($user);

            DB::commit();

            // Redireciona para o perfil já logado
            return redirect()->route('perfil.show', ['profile_slug' => $user->profile_slug])
                             ->with('success', 'Cadastro realizado com sucesso! Você já está logado.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors([
                'error' => 'Erro ao cadastrar usuário. Tente novamente.',
            ]);
        }
    }
}
