<?php

namespace App\Http\Middleware;

use App\Http\Services\LoginService;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Logout extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        $profile = empty($guards) ? null : $guards[0];

        if (Auth::guard($profile)->check()) {
            LoginService::logout($profile);
        }

        return $next($request);
    }
}
