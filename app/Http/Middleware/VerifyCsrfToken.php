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
}