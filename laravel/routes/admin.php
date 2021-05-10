<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->prefix('admin')->group(function() {

    Route::namespace('Auth')->middleware('auth:admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AlunoController::class, 'admin'])->name('dashboard');
        Route::get('/cursos', [CursoController::class, 'index'])->name('cursos');
        Route::get('/matriculas/{id}', [MatriculaController::class, 'admin'])->name('matriculas');
        Route::redirect('/logout', '/')->middleware('logout:admin')->name('logout');

        Route::prefix('aluno')->group(function() {
            Route::post('/cadastrar', [AlunoController::class, 'cadastrar'])->name('cadastrar.aluno');
            Route::patch('/atualizar', [AlunoController::class, 'atualizar'])->name('atualizar.aluno');
            Route::delete('/deletar', [AlunoController::class, 'deletar'])->name('deletar.aluno');
        });

        Route::prefix('curso')->group(function() {
            Route::post('/cadastrar', [CursoController::class, 'cadastrar'])->name('cadastrar.curso');
            Route::patch('/atualizar', [CursoController::class, 'atualizar'])->name('atualizar.curso');
            Route::delete('/deletar', [CursoController::class, 'deletar'])->name('deletar.curso');
        });

        Route::prefix('matricula')->group(function() {
            Route::post('/cadastrar', [MatriculaController::class, 'cadastrar'])->name('cadastrar.matricula');
            Route::patch('/atualizar', [MatriculaController::class, 'atualizar'])->name('atualizar.matricula');
            Route::delete('/deletar', [MatriculaController::class, 'deletar'])->name('deletar.matricula');
        });

    });

});
