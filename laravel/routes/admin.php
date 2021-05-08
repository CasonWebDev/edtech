<?php


use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::namespace('Admin')->prefix('admin')->group(function() {

    Route::namespace('Auth')->middleware('auth:admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard', ['profile' => 'admin']);
        })->name('dashboard');

        Route::post('/logout', [LoginController::class, 'index'])->middleware('logout:admin')->name('logout');

    });

});
