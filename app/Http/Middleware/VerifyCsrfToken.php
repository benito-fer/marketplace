<<<<<<< HEAD
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Las URIs que deberían ser excluidas de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        'registro',
        'login'
    ];
=======
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Ninguna ruta debe estar aquí para login/register
    ];
>>>>>>> master
}