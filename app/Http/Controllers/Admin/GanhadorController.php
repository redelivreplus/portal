<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NumeroDaSorte;
use Illuminate\Http\Request;

class GanhadorController extends Controller
{
    /**
     * Armazena ganhador manualmente (caso necessário)
     */
    public function store(Request $request)
    {
        return redirect()->back()->with('status', '🎉 Ganhador registrado com sucesso!');
    }

    /**
     * Retorna dados do ganhador para o modal de sorteio ao vivo
     */
    public function buscar(Request $request)
    {
        $numero = $request->get('numero');

        // Busca o número premiado com dados do usuário e cidade
        $ganhador = NumeroDaSorte::with(['usuario.city'])
            ->where('numero', $numero)
            ->where('premiado', true)
            ->first();

        if (!$ganhador || !$ganhador->usuario) {
            return response()->json(['erro' => 'Número não premiado ou usuário não encontrado.'], 404);
        }

        $usuario = $ganhador->usuario;
        $cidade  = $usuario->city;

        return response()->json([
            'nome'    => $usuario->name ?? '-',
            'cidade'  => $cidade->name ?? '-',
            'uf'      => $cidade->state ?? '-',
            'fone'    => $usuario->phone ?? '-',
            'time'    => $usuario->time ?? '-', // certifique-se que esse campo existe no users
            'premio'  => $ganhador->premio ?? null,
            'posicao' => $ganhador->posicao ?? null,
        ]);
    }
}


\App\Models\NumeroDaSorte::where('numero', '2513764')->update(['premiado' => true]);
