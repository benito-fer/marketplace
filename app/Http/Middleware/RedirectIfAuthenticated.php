<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redirigir según el rol del usuario autenticado
                if ($user->rol === 'comerciante') {
                    return redirect()->route('dashboard');
                } elseif ($user->rol === 'cliente') {
                    return redirect()->route('home');
                }

                // Redirigir a una ruta predeterminada si el rol no coincide
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}