<?php


namespace App\Http\Services\Matriculas;


use App\Http\Requests\MatriculaRequest;
use App\Models\Matricula;

class CadastrarMatriculaService
{
    public function index(MatriculaRequest $request)
    {
        Matricula::create([
            'aluno_id' => $request->aluno_id,
            'curso_id' => $request->curso_id,
            'ativo' => $request->ativo,
            'data_admissao' => $request->data_admissao
        ]);

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Matricula efetuada com sucesso']);
    }
}
