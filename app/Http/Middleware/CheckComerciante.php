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
        // Verificar si el usuario está autenticado y tiene el rol de comerciante
        if (Auth::check() && Auth::user()->rol === 'comerciante') {
            return $next($request);
        }

        // Manejar solicitudes JSON con una respuesta adecuada
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Acceso restringido a comerciantes'
            ], 403);
        }

        // Redirigir a la página de inicio con un mensaje de error para solicitudes normales
        return redirect()->route('home')->with('error', 'Acceso restringido a comerciantes');
    }
}