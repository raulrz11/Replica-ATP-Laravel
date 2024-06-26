<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRolMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()&&Auth::user()->rol === 'USER') {
            return $next($request);
        }
        return redirect('login')->with('error', 'Acceso denegado, no tienes permisos suficientes');
    }
}
