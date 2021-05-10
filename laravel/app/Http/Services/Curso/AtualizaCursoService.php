<?php


namespace App\Http\Services\Curso;


use App\Http\Requests\CursoRequest;
use App\Models\Curso;

class AtualizaCursoService
{
    public function index(CursoRequest $request)
    {
        Curso::where('id', $request->id)
            ->update([
                'nome' => $request->nome,
                'data_inicio' => $request->data_inicio
            ]);

        session()->flash('message', ['type' => 'info', 'title' => 'Sucesso!', 'text' => 'Curso atualizado com sucesso']);
    }
}
