<?php


namespace App\Http\Services;


use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function autenticar(LoginRequest $request): string
    {
        try {
            $request->autenticaAdmin();
            return RouteServiceProvider::HOME_ADMIN;
        } catch (ValidationException) {
            $request->autenticaAluno();
            return RouteServiceProvider::HOME_ALUNO;
        }
    }

    public static function logout(string $perfil): void
    {
        Auth::guard($perfil)->logout();
    }
}
