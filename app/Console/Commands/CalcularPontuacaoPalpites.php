<?php



namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jogo;
use App\Models\Palpite;

class CalcularPontuacaoPalpites extends Command
{
    protected $signature = 'calcular:pontuacao';

    protected $description = 'Calcula os pontos de todos os palpites com base nos resultados oficiais';

    public function handle()
    {
        $jogos = Jogo::whereNotNull('resultado_oficial')->with('palpites')->get();
        $totalAtualizados = 0;

        foreach ($jogos as $jogo) {
            foreach ($jogo->palpites as $palpite) {
                $acertou = $palpite->palpite === $jogo->resultado_oficial;

                $palpite->acerto_exato = $acertou ? 1 : 0;
                $palpite->acerto_resultado = $acertou ? 1 : 0;
                $palpite->pontos = $acertou ? 3 : 0;

                $palpite->save();
                $totalAtualizados++;
            }
        }

        $this->info("Pontuação atualizada com sucesso para $totalAtualizados palpites.");
    }
}
