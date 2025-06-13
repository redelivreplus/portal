<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sorteio;
use App\Models\Premio;

class PremiosController extends Controller
{
    public function store(Request $request)
    {
        $sorteio = Sorteio::latest()->first();

        if (!$sorteio) {
            return back()->with('error', 'Nenhum sorteio ativo encontrado.');
        }

        $premios = $request->input('premios', []);
        $contador = 0;

        foreach ($premios as $posicao => $descricao) {
            if (!empty($descricao)) {
                Premio::updateOrCreate(
                    ['sorteio_id' => $sorteio->id, 'posicao' => $posicao],
                    [
                        'descricao' => $descricao,
                        'premio_extra' => $request->has('premio_extra'),
                    ]
                );
                $contador++;
            }
        }

        return back()->with('status', "$contador prêmio" . ($contador === 1 ? '' : 's') . " cadastrados com sucesso!");
    }
}
