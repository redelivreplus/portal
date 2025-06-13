<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizMatchController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PalpiteController;
use App\Http\Controllers\CanalController;
use App\Http\Controllers\RodadaController;
use App\Http\Controllers\RodadaPalpiteController;
use App\Http\Controllers\Numero\NumeroDaSorteController;
use App\Http\Controllers\Admin\NumeroDaSorteAdminController;
use App\Http\Controllers\Admin\SorteioController;
use App\Http\Controllers\Admin\GanhadorController;
use App\Http\Controllers\Admin\PremiosController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('index'))->name('home');

Route::view('/sobre-nos', 'institucional.sobre')->name('sobre');
Route::view('/expediente', 'institucional.expediente')->name('expediente');
Route::view('/politica-de-privacidade', 'institucional.privacidade')->name('privacidade');
Route::view('/termos-de-uso', 'institucional.termos')->name('termos');
Route::view('/responsabilidade', 'institucional.responsabilidade')->name('responsabilidade');
Route::view('/fale-conosco', 'institucional.fale-conosco')->name('faleconosco');
Route::view('/termo-participacao', 'institucional.termo-participacao')->name('institucional.termo-participacao');

Route::post('/fale-conosco', function (Request $request) {
    return back()->with('success', 'Mensagem enviada com sucesso!');
})->name('faleconosco.enviar');

/*
|--------------------------------------------------------------------------
| Autenticação (Usuário comum)
|--------------------------------------------------------------------------
*/

Route::get('/cadastro', [UserController::class, 'create'])->name('cadastro.form');
Route::post('/cadastro', [UserController::class, 'store'])->name('cadastro.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Autenticação (Admin)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::post('/admin/premios/store', [PremiosController::class, 'store'])->name('admin.premios.store');

/*
|--------------------------------------------------------------------------
| Rotas de Usuário Logado
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/{profile_slug}/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/{profile_slug}', [PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/{profile_slug}/seguir', [PerfilController::class, 'seguir'])->name('perfil.seguir');
    Route::post('/perfil/{profile_slug}/desseguir', [PerfilController::class, 'desseguir'])->name('perfil.desseguir');

    Route::get('/palpites', [PalpiteController::class, 'index'])->name('palpites.index');
    Route::post('/palpites', [PalpiteController::class, 'store'])->name('palpites.store');
    Route::get('/palpites/confirmacao/{slug}', [PalpiteController::class, 'confirmacao'])->name('palpites.confirmacao');

    Route::get('/gerar-numero', [NumeroDaSorteController::class, 'gerar'])->name('numero.gerar');

    Route::resource('rodadas', RodadaController::class);
    Route::post('rodadas/{rodada}/encerrar', [RodadaController::class, 'encerrar'])->name('rodadas.encerrar');
    Route::get('rodadas/{rodada}/ranking', [RodadaController::class, 'ranking'])->name('rodadas.ranking');
    Route::post('rodadas/{rodada}/finalizar', [RodadaController::class, 'finalizar'])->name('rodadas.finalizar');
    Route::post('/rodadas/{rodada}/palpites', [RodadaPalpiteController::class, 'salvarPalpites'])->name('rodadas.salvarPalpites');
    Route::get('/rodadas/{rodada}/meus-palpites', [RodadaPalpiteController::class, 'confirmacao'])->name('rodadas.confirmacao');

    Route::get('/canais', [CanalController::class, 'index'])->name('canais.index');
    Route::get('/canais/create', [CanalController::class, 'create'])->name('canais.create');
    Route::post('/canais', [CanalController::class, 'store'])->name('canais.store');
    Route::get('/canais/{canal}', [CanalController::class, 'show'])->name('canais.show');
    Route::get('/canais/{canal}/edit', [CanalController::class, 'edit'])->name('canais.edit');
    Route::put('/canais/{canal}', [CanalController::class, 'update'])->name('canais.update');
});

Route::get('/perfil/{profile_slug}', [PerfilController::class, 'show'])->name('perfil.show');
Route::get('/quiz/resultados/{quizMatch:slug}', [QuizMatchController::class, 'resultado'])->name('quiz.resultado');

/*
|--------------------------------------------------------------------------
| Admin — Rotas Protegidas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/quiz', [QuizMatchController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/create', [QuizMatchController::class, 'create'])->name('quiz.create');
    Route::post('/quiz', [QuizMatchController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/{quizMatch:slug}/edit', [QuizMatchController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{quizMatch:slug}', [QuizMatchController::class, 'update'])->name('quiz.update');

    // Sorteio que já marca o número como premiado automaticamente
    Route::get('/sortear/numero', function () {
        $numeroObj = \App\Models\NumeroDaSorte::ativos()
            ->whereNotNull('numero')
            ->whereNotNull('user_id')
            ->inRandomOrder()
            ->first();

        if (!$numeroObj) {
            return response()->json(['erro' => 'Nenhum número disponível'], 404);
        }

        $numeroObj->update(['premiado' => true]);

        return response()->json(['numero' => $numeroObj->numero]);
    })->name('sortear.numero');

    Route::get('/numeros-da-sorte', [NumeroDaSorteAdminController::class, 'index'])->name('numeros.index');
    Route::delete('/numeros-da-sorte/limpar', [NumeroDaSorteAdminController::class, 'limpar'])->name('numeros.limpar');

    Route::get('/numerodasorte/sorteio', [SorteioController::class, 'index'])->name('numerodasorte.sorteio');
    Route::post('/sorteios', [SorteioController::class, 'store'])->name('sorteios.store');

    Route::post('/ganhador', [GanhadorController::class, 'store'])->name('ganhador.store');
    Route::get('/ganhador/buscar', [GanhadorController::class, 'buscar'])->name('ganhador.buscar');
});
