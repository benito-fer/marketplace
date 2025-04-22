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
        \App\Http\Middleware\CorsMiddleware::class,
    ];

    /**
     * Middleware agrupados
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\VerifyCsrfToken::class,
            // otros middlewares del grupo web...
        ],

        'api' => [
            // middleware del grupo api...
        ],
    ];
}
