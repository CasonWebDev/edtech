<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatriculaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Matricula::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dados_mock = $this->obterDadosUnicosMock();

        return [
            'aluno_id' => $dados_mock['aluno_id'],
            'curso_id' => $dados_mock['curso_id'],
            'ativo' => 1
        ];
    }

    private function obterDadosUnicosMock(): array
    {
        do {
            $aluno_id = Aluno::inRandomOrder()->first()->id;
            $curso_id = Curso::inRandomOrder()->first()->id;
            $matricula = Matricula::where([
                'aluno_id' => $aluno_id,
                'curso_id' => $curso_id
            ])->get()->count();
        } while ($matricula > 0);

        return [
            'aluno_id' => $aluno_id,
            'curso_id' => $curso_id
        ];
    }
}
