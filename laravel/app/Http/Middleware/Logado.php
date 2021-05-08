<?php

namespace App\Http\Middleware;

use App\Http\Services\LoginService;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Logado extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        $guards = Arr::except(config('auth.guards'), ['web', 'sanctum', 'api']);

        foreach ($guards as $guard => $values) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route($guard.'.dashboard');
            }
        }

        return $next($request);
    }
}
