<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatriculaRequest;
use App\Http\Services\Matriculas\AtualizaMatriculaService;
use App\Http\Services\Matriculas\CadastrarMatriculaService;
use App\Http\Services\Matriculas\DeletarMatriculaService;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MatriculaController extends Controller
{
    public function __construct(
        private CadastrarMatriculaService $cadastrarMatriculaService,
        private AtualizaMatriculaService $atualizaMatriculaService,
        private DeletarMatriculaService $deletarMatriculaService
    ) {}

    public function admin(int $id)
    {
        $dados = [
            'profile' => 'admin',
            'matriculas' => Matricula::matriculasAluno($id),
            'cursos' => Curso::all(),
            'aluno' => Aluno::find($id)
        ];

        return Inertia::render('Admin/Matriculas', $dados);
    }

    public function aluno()
    {
        $id = Auth::user()->id;

        $dados = [
            'profile' => 'aluno',
            'matriculas' => Matricula::matriculasAluno($id),
            'cursos' => Curso::all(),
            'aluno' => Aluno::find($id)
        ];

        return Inertia::render('Aluno/Dashboard', $dados);
    }

    public function cadastrar(MatriculaRequest $request)
    {
        $redirectUrl = 'admin.matriculas';

        if (Auth::user() instanceof Aluno) {
            $redirectUrl = 'aluno.dashboard';
        }

        try {
            $this->cadastrarMatriculaService->index($request);
            return Redirect::route($redirectUrl, ['id' => $request->aluno_id]);
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function atualizar(MatriculaRequest $request)
    {

        $redirectUrl = 'admin.matriculas';

        if (Auth::user() instanceof Aluno) {
            $redirectUrl = 'aluno.dashboard';
        }

        try {
            $this->atualizaMatriculaService->index($request);
            return Redirect::route($redirectUrl, ['id' => $request->aluno_id]);
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function deletar(Request $request)
    {
        $redirectUrl = 'admin.matriculas';

        if (Auth::user() instanceof Aluno) {
            $redirectUrl = 'aluno.dashboard';
        }

        try {
            $this->deletarMatriculaService->index($request->id);
            return Redirect::route($redirectUrl, ['id' => $request->aluno_id]);
        } catch (BadRequestException $e) {
            throw $e;
        }
    }
}
