<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

Route::namespace('Aluno')->prefix('aluno')->group(function(){

    Route::namespace('Auth')->middleware('auth:aluno')->name('aluno.')->group(function(){

        Route::get('/dashboard', [MatriculaController::class, 'aluno'])->name('dashboard');
        Route::patch('/atualizar', [AlunoController::class, 'atualizar'])->name('atualizar.aluno');
        Route::redirect('/logout', '/')->middleware('logout:aluno')->name('logout');

        Route::prefix('matricula')->group(function() {
            Route::post('/cadastrar', [MatriculaController::class, 'cadastrar'])->name('cadastrar.matricula');
            Route::patch('/atualizar', [MatriculaController::class, 'atualizar'])->name('atualizar.matricula');
            Route::delete('/deletar', [MatriculaController::class, 'deletar'])->name('deletar.matricula');
        });

    });

});
