<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckComerciante
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->rol === 'comerciante') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Acceso restringido a comerciantes');
    }
}