<?php


namespace App\Http\Services\Matriculas;


use App\Models\Matricula;

class DeletarMatriculaService
{
    public function index(int $id)
    {
        Matricula::find($id)->delete();

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Matricula deletada com sucesso']);
    }
}
