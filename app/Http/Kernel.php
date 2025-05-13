<<<<<<< HEAD
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
=======
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
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Add this
            // otros middlewares del grupo web...
        ],

        'api' => [
            'throttle:api', // Consider adding this
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // And this
        ],
    ];
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Ensure this is present
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'comerciante' => \App\Http\Middleware\CheckComerciante::class,
    ];
}
>>>>>>> master
