<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware global
     */
    protected $middleware = [
        // Otros middlewares...
        \App\Http\Middleware\CorsMiddleware::class, // Middleware para manejar CORS
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class, // Verificar modo de mantenimiento
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Validar tamaño de las solicitudes POST
        \App\Http\Middleware\TrimStrings::class, // Eliminar espacios en cadenas
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Convertir cadenas vacías a null
    ];

    /**
     * Middleware agrupados
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // Encriptar cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Agregar cookies a la respuesta
            \Illuminate\Session\Middleware\StartSession::class, // Iniciar sesión
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Compartir errores desde la sesión
            \App\Http\Middleware\VerifyCsrfToken::class, // Verificar CSRF
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Sustituir enlaces de rutas
        ],

        'api' => [
            'throttle:api', // Limitar solicitudes API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Sustituir enlaces de rutas
        ],
    ];

    /**
     * Middleware de rutas individuales
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Middleware de autenticación
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Autenticación básica
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // Configurar encabezados de caché
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Autorización basada en políticas
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Redirigir si está autenticado
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class, // Validar firmas de URL
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Limitar solicitudes
        'comerciante' => \App\Http\Middleware\CheckComerciante::class, // Middleware para comerciantes
    ];
}
