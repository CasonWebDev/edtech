<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Http\Services\Curso\AtualizaCursoService;
use App\Http\Services\Curso\CadastrarCursoService;
use App\Http\Services\Curso\DeletarCursoService;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CursoController extends Controller
{
    public function __construct(
        private CadastrarCursoService $cadastrarCursoService,
        private AtualizaCursoService $atualizaCursoService,
        private DeletarCursoService $deletarCursoService
    ){}

    public function index()
    {
        $dados = [
            'profile' => 'admin',
            'cursos' => Curso::lista()
        ];

        return Inertia::render('Admin/Cursos', $dados);
    }

    public function cadastrar(CursoRequest $request)
    {
        try {
            $this->cadastrarCursoService->index($request);
            return Redirect::route('admin.cursos');
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function atualizar(CursoRequest $request)
    {
        try {
            $this->atualizaCursoService->index($request);
            return Redirect::route('admin.cursos');
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function deletar(Request $request)
    {
        try {
            $this->deletarCursoService->index($request->id);
            return Redirect::route('admin.cursos');
        } catch (BadRequestException $e) {
            throw $e;
        }
    }
}
