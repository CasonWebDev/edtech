<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroAlunoRequest;
use App\Http\Requests\AtualizarAlunoRequest;
use App\Http\Services\Aluno\CadastrarAlunoService;
use App\Http\Services\Aluno\AtualizaAlunoService;
use App\Http\Services\Aluno\DeletarAlunoService;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AlunoController extends Controller
{
    public function __construct(
        private CadastrarAlunoService $cadastrarAlunoService,
        private AtualizaAlunoService $atualizaAlunoService,
        private DeletarAlunoService $deletarAlunoService
    ) {}

    public function admin()
    {
        $dados = [
            'profile' => 'admin',
            'alunos' => Aluno::lista()
        ];

        return Inertia::render('Admin/Dashboard', $dados);
    }

    public function cadastrar(CadastroAlunoRequest $request)
    {
        try {
            $this->cadastrarAlunoService->index($request);
            return Redirect::route('admin.dashboard');
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function atualizar(AtualizarAlunoRequest $request)
    {
        $redirectUrl = 'admin.dashboard';

        if (Auth::user() instanceof Aluno) {
            $redirectUrl = 'aluno.dashboard';
        }

        try {
            $this->atualizaAlunoService->index($request);
            return Redirect::route($redirectUrl);
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function deletar(Request $request)
    {
        try {
            $this->deletarAlunoService->index($request->id);
            return Redirect::route('admin.dashboard');
        } catch (BadRequestException $e) {
            throw $e;
        }
    }
}
