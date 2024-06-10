<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRolMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()&&Auth::user()->rol === 'ADMIN') {
            return $next($request);
        }
        return redirect('login')->with('error', 'Acceso denegado, no tienes permisos suficientes');
    }
}

