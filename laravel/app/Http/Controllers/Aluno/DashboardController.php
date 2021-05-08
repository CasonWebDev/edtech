<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $dados = ['profile' => 'aluno'];

        return Inertia::render('Dashboard', $dados);
    }
}
