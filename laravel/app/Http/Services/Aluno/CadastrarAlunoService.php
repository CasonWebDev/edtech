<?php


namespace App\Http\Services\Aluno;


use App\Http\Requests\CadastroAlunoRequest;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;

class CadastrarAlunoService
{
    public function index(CadastroAlunoRequest $request)
    {
        Aluno::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha)
        ]);

        session()->flash('message', ['type' => 'success', 'title' => 'Sucesso!', 'text' => 'Aluno cadastrado com sucesso']);
    }
}
