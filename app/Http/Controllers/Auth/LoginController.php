<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Realiza o login do usuário.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {

            $user = Auth::user();

            return redirect()->route('perfil.show', [
                'profile_slug' => $user->profile_slug
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas não são válidas.'],
        ]);
    }

    /**
     * Realiza o logout do usuário.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
