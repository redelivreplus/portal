<?php

namespace App\Http\Controllers;

use App\Models\QuizMatch;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware para garantir autenticação admin
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $jogos = QuizMatch::orderByDesc('id')->get();
        return view('admin.dashboard', compact('jogos'));
    }
}
