<?php


namespace App\Http\Services\Curso;


use App\Http\Requests\CursoRequest;
use App\Models\Curso;

class CadastrarCursoService
{
    public function index(CursoRequest $request)
    {
        Curso::create([
            'nome' => $request->nome,
            'data_inicio' => $request->data_inicio
        ]);

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Curso cadastrado com sucesso']);
    }
}
