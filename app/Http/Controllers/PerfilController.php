<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rodada;
use App\Models\Canal;
use App\Models\NumeroDaSorte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'seguir', 'desseguir', 'edit', 'update'
        ]);
    }

    /**
     * Exibe o perfil de um usuário.
     */
    public function show($profile_slug)
    {
        $user = User::where('profile_slug', $profile_slug)->firstOrFail();

        $cravados = $user->palpites()->where('points', 3)->count();
        $parciais = $user->palpites()->where('points', 1)->count();
        $errados = $user->palpites()->where('points', 0)->count();

        $totalCanais = Canal::count();

        $authUser = Auth::user();
        $isFollowing = $authUser
            ? $authUser->following()->where('followed_id', $user->id)->exists()
            : false;

        $rodada = Rodada::where('status', false)->latest()->first();

        // Recupera o número da sorte apenas se o perfil visualizado for o do próprio usuário
        $numero = $authUser && $authUser->id === $user->id
            ? NumeroDaSorte::where('user_id', $user->id)->latest()->first()
            : null;

        return view('perfil.show', compact(
            'user',
            'cravados',
            'parciais',
            'errados',
            'isFollowing',
            'totalCanais',
            'rodada',
            'numero'
        ));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit($profile_slug)
    {
        $user = User::where('profile_slug', $profile_slug)->firstOrFail();

        if (Auth::id() !== $user->id) {
            abort(403, 'Acesso negado');
        }

        return view('perfil.edit', compact('user'));
    }

    /**
     * Atualiza os dados do perfil.
     */
    public function update(Request $request, $profile_slug)
    {
        $user = User::where('profile_slug', $profile_slug)->firstOrFail();

        if (Auth::id() !== $user->id) {
            abort(403, 'Acesso negado');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'birth_date' => 'nullable|date',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user->fill($validatedData);

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image_url = $imagePath;
        }

        $user->address = $request->input('address');
        $user->neighborhood = $request->input('neighborhood');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->phone = $request->input('phone');
        $user->whatsapp = $request->input('whatsapp');
        $user->instagram_profile_url = $request->input('instagram_profile_url');
        $user->facebook_profile_url = $request->input('facebook_profile_url');
        $user->youtube_profile_url = $request->input('youtube_profile_url');
        $user->interests = $request->input('interests');
        $user->bio = $request->input('bio');
        $user->show_bio = $request->has('show_bio');
        $user->show_interests = $request->has('show_interests');

        $user->save();

        return redirect()->route('perfil.show', $user->profile_slug)
            ->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Seguir outro usuário.
     */
    public function seguir(Request $request, $profile_slug)
    {
        $userToFollow = User::where('profile_slug', $profile_slug)->firstOrFail();
        $authUser = Auth::user();

        if ($authUser->id === $userToFollow->id) {
            return redirect()->back()->with('error', 'Você não pode seguir você mesmo.');
        }

        if (!$authUser->following()->where('followed_id', $userToFollow->id)->exists()) {
            $authUser->following()->attach($userToFollow->id);
            return redirect()->back()->with('success', 'Você está seguindo ' . $userToFollow->name);
        }

        return redirect()->back()->with('info', 'Você já segue este usuário.');
    }

    /**
     * Deixar de seguir um usuário.
     */
    public function desseguir(Request $request, $profile_slug)
    {
        $userToUnfollow = User::where('profile_slug', $profile_slug)->firstOrFail();
        $authUser = Auth::user();

        if ($authUser->following()->where('followed_id', $userToUnfollow->id)->exists()) {
            $authUser->following()->detach($userToUnfollow->id);
            return redirect()->back()->with('success', 'Você deixou de seguir ' . $userToUnfollow->name);
        }

        return redirect()->back()->with('info', 'Você não está seguindo este usuário.');
    }
}
