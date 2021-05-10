<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        Aluno::factory()->count(100)->create();
        Curso::factory()->count(10)->create();
        Matricula::factory()->count(120)->create();
    }
}
