<?php

namespace App\Http\Controllers\Numero;

use App\Http\Controllers\Controller;
use App\Models\NumeroDaSorte;
use App\Models\Sorteio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NumeroDaSorteController extends Controller
{
    public function gerar()
    {
        $user = Auth::user();

        // Pega o sorteio ativo
        $sorteio = Sorteio::where('ativo', true)->orderBy('data')->first();
        if (!$sorteio) {
            return response()->json(['erro' => 'Nenhum sorteio ativo no momento.'], 404);
        }

        // Verifica se o usuário já gerou número para este sorteio
        $existe = NumeroDaSorte::where('user_id', $user->id)
                               ->where('sorteio_id', $sorteio->id)
                               ->first();

        if ($existe) {
            return response()->json([
                'erro' => 'Você já possui um número da sorte para este sorteio.',
                'numero' => $existe->numero
            ], 403);
        }

        // Geração do número com validação de unicidade e regra de sequência
        do {
            $digitos = collect(range(0, 9))->shuffle()->take(7);
            $numero = $digitos->implode('');
        } while (
            $this->numeroInvalido($digitos) ||
            NumeroDaSorte::where('numero', $numero)->exists()
        );

        // Salva no banco
        $registro = NumeroDaSorte::create([
            'user_id'    => $user->id,
            'sorteio_id' => $sorteio->id,
            'numero'     => $numero,
            'ativo'      => true,
            'premiado'   => false,
            'gerado_em'  => now(),
        ]);

        return response()->json([
            'numero' => $registro->numero,
            'proximo_sorteio' => $sorteio->data->format('d/m/Y')
        ]);
    }

    private function numeroInvalido($digitos)
    {
        $valores = $digitos->toArray();
        $frequencias = array_count_values($valores);

        // Regra: mais de 3 dígitos iguais
        foreach ($frequencias as $qtd) {
            if ($qtd > 3) return true;
        }

        // Regra: sequência direta crescente ou decrescente
        for ($i = 0; $i < 5; $i++) {
            $a = $valores[$i];
            $b = $valores[$i + 1];
            $c = $valores[$i + 2];

            if (
                ($b == $a + 1 && $c == $b + 1) ||
                ($b == $a - 1 && $c == $b - 1)
            ) {
                return true;
            }
        }

        return false;
    }
}
