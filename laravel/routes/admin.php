<?php


use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::namespace('Admin')->prefix('admin')->group(function() {

    Route::namespace('Auth')->middleware('auth:admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/logout', [LoginController::class, 'index'])->middleware('logout:admin')->name('logout');

    });

});
