<?php

namespace App\Http\Controllers;

use App\Models\Canal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CanalController extends Controller
{
    // Lista todos os canais
    public function index()
    {
        $canais = Canal::latest()->get();
        return view('canais.index', compact('canais'));
    }

    // Exibe formulário para criar canal
    public function create()
    {
        return view('canais.create');
    }

    // Salva novo canal
    public function store(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'cidade'       => 'nullable|string|max:255',
            'estado'       => 'nullable|string|max:2',
            'cep'          => 'nullable|string|max:9',
            'url'          => 'required|url|max:255',
            'logo'         => 'required|image|max:2048',
            'responsavel'  => 'nullable|string|max:255',
            'telefone'     => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
            'funcao'       => 'nullable|string|max:255',
        ]);

        $path = $request->file('logo')->store('logos', 'public');

        Canal::create([
            'nome'         => $request->nome,
            'cidade'       => $request->cidade,
            'estado'       => $request->estado,
            'cep'          => $request->cep,
            'url'          => $request->url,
            'logo'         => $path,
            'responsavel'  => $request->responsavel,
            'telefone'     => $request->telefone,
            'email'        => $request->email,
            'funcao'       => $request->funcao,
            'user_id'      => Auth::id(), // Armazenando o ID do usuário logado
        ]);

        return redirect()->route('canais.index')->with('success', 'Canal criado com sucesso!');
    }

    // Mostra detalhes de um canal específico
    public function show(Canal $canal)
    {
        $prevCanal = Canal::where('id', '<', $canal->id)->orderBy('id', 'desc')->first();
        $nextCanal = Canal::where('id', '>', $canal->id)->orderBy('id', 'asc')->first();

        return view('canais.show', compact('canal', 'prevCanal', 'nextCanal'));
    }

    // Exibe o formulário de edição de um canal
    public function edit($id)
    {
        $canal = Canal::findOrFail($id);

        // Verifica se o usuário é o criador ou um administrador
        if ($canal->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Você não tem permissão para editar este canal.');
        }

        return view('canais.edit', compact('canal'));
    }

    // Atualiza as informações de um canal
    public function update(Request $request, $id)
    {
        $canal = Canal::findOrFail($id);

        // Verifica se o usuário é o criador ou um administrador
        if ($canal->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Você não tem permissão para editar este canal.');
        }

        $request->validate([
            'nome'         => 'required|string|max:255',
            'cidade'       => 'nullable|string|max:255',
            'estado'       => 'nullable|string|max:2',
            'cep'          => 'nullable|string|max:9',
            'url'          => 'required|url|max:255',
            'logo'         => 'nullable|image|max:2048',
            'responsavel'  => 'nullable|string|max:255',
            'telefone'     => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
            'funcao'       => 'nullable|string|max:255',
        ]);

        // Atualiza os dados do canal
        $canal->update([
            'nome'         => $request->nome,
            'cidade'       => $request->cidade,
            'estado'       => $request->estado,
            'cep'          => $request->cep,
            'url'          => $request->url,
            'responsavel'  => $request->responsavel,
            'telefone'     => $request->telefone,
            'email'        => $request->email,
            'funcao'       => $request->funcao,
        ]);

        // Se houver uma nova logo, faz o upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $canal->update(['logo' => $path]);
        }

        return redirect()->route('canais.show', $canal->id)->with('success', 'Canal atualizado com sucesso!');
    }

    // Método para retornar a quantidade total de canais cadastrados
    public static function getTotalCanais()
    {
        return Canal::count();
    }
}
