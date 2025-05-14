<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CspMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Definir una política de seguridad de contenido más estricta
        $csp = [
            "default-src 'self'",
            "script-src 'self'", // Eliminado 'unsafe-inline' y 'unsafe-eval' por seguridad
            "connect-src 'self'",
            "style-src 'self' 'unsafe-inline'", // 'unsafe-inline' puede ser necesario para estilos en línea
            "img-src 'self' data:",
            "font-src 'self'",
        ];

        // Unir las directivas CSP en una sola cadena
        $response->headers->set('Content-Security-Policy', implode('; ', $csp) . ';');

        return $response;
    }
}