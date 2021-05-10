<?php


namespace App\Http\Services\Matriculas;


use App\Http\Requests\MatriculaRequest;
use App\Models\Matricula;

class AtualizaMatriculaService
{
    public function index(MatriculaRequest $request)
    {
        Matricula::where('id', $request->id)
            ->update([
                'aluno_id' => $request->aluno_id,
                'curso_id' => $request->curso_id,
                'data_admissao' => $request->data_admissao,
                'ativo' => $request->ativo
            ]);

        session()->flash('message', ['type' => 'info', 'title' => 'Sucesso!', 'text' => 'Matricula atualizada com sucesso']);
    }
}
