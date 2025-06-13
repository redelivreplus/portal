<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NumeroDaSorte;
use App\Models\Sorteio;

class NumeroDaSorteAdminController extends Controller
{
    /**
     * Exibe o total de números da sorte, o sorteio ativo atual e os prêmios associados.
     */
    public function index()
    {
        // Conta os números da sorte cadastrados
        $totalNumeros = NumeroDaSorte::count();

        // Recupera o sorteio ativo mais recente
        $sorteioAtivo = Sorteio::where('ativo', true)->latest()->first();

        // Coleta os prêmios vinculados a esse sorteio, agrupados por posição (1 a 20)
        $premios = $sorteioAtivo
            ? $sorteioAtivo->premios->keyBy('posicao')
            : collect();

        // Retorna para a view com todos os dados necessários
        return view('admin.numerodasorte.index', compact(
            'totalNumeros',
            'sorteioAtivo',
            'premios'
        ));
    }

    /**
     * Limpa todos os números da sorte e exclui o sorteio ativo (incluindo prêmios vinculados).
     */
    public function limpar()
    {
        $totalApagados = NumeroDaSorte::count();

        // Apaga todos os números da sorte
        NumeroDaSorte::truncate();

        // Exclui sorteios ativos (e os prêmios associados via cascade)
        Sorteio::where('ativo', true)->delete();

        return redirect()
            ->route('admin.numeros.index')
            ->with('status', "✅ $totalApagados número(s) da sorte e o sorteio atual foram apagados com sucesso!");
    }
}
