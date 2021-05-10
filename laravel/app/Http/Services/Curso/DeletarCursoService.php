<?php


namespace App\Http\Services\Curso;


use App\Models\Curso;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeletarCursoService
{
    public function index(int $id)
    {
        $curso = Curso::with('matriculas')->find($id);

        if (! $curso->has('matriculas', '>', 0)) {
            throw new BadRequestException("Curso em matriculas ativas não pode ser deletado", Response::HTTP_BAD_REQUEST);
        }

        $curso->delete();

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Curso deletado com sucesso']);
    }
}
