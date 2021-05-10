<?php


namespace App\Http\Services\Aluno;


use App\Http\Requests\AtualizarAlunoRequest;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;

class AtualizaAlunoService
{
    public function index(AtualizarAlunoRequest $request)
    {
        $aluno = Aluno::find($request->id);

        $senha = $aluno->senha;

        if ($request->senha) {
            $senha = Hash::make($request->senha);
        }

        $aluno->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $senha
        ]);

        session()->flash('message', ['type' => 'info', 'title' => 'Sucesso!', 'text' => 'Aluno atualizado com sucesso']);
    }
}
