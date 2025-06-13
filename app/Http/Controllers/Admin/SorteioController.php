<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sorteio;

class SorteioController extends Controller
{
    /**
     * Exibe a view de sorteio.
     */
    public function index()
    {
        return view('admin.numerodasorte.sorteio');
    }

    /**
     * Salva um novo sorteio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
        ]);

        // Desativa sorteios ativos
        Sorteio::where('ativo', true)->update(['ativo' => false]);

        Sorteio::create([
            'descricao' => $request->descricao,
            'data' => $request->data,
            'ativo' => true,
        ]);

        return redirect()->back()->with('status', 'Novo sorteio criado com sucesso!');
    }
}
