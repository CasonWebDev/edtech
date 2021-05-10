<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\LoginService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService
    ){}

    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function entrar(LoginRequest $request): RedirectResponse
    {
        try {
            $dashboard = $this->loginService->autenticar($request);
            return redirect()->route($dashboard);
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
