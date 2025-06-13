<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\QuizMatch;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Compartilha a variável $ultimoJogo em todas as views que usam layouts.app
        View::composer('layouts.app', function ($view) {
            $ultimoJogo = QuizMatch::orderByDesc('match_date')
                ->orderByDesc('match_time')
                ->first();

            $view->with('ultimoJogo', $ultimoJogo);
        });
    }
}
