<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Aluno\DashboardController;

Route::namespace('Aluno')->prefix('aluno')->group(function(){

    Route::namespace('Auth')->middleware('auth:aluno')->name('aluno.')->group(function(){

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/logout', [LoginController::class, 'index'])->middleware('logout:aluno')->name('logout');

    });

});
