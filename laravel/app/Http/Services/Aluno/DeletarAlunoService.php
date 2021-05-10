<?php


namespace App\Http\Services\Aluno;


use App\Models\Aluno;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeletarAlunoService
{
    public function index(int $id)
    {
        $aluno = Aluno::with('matriculas')->find($id);

        if (! $aluno->has('matriculas', '>', 0)) {
            throw new BadRequestException("Aluno matriculado em algum curso não pode ser deletado", Response::HTTP_BAD_REQUEST);
        }

        $aluno->delete();

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Aluno deletado com sucesso']);
    }
}
