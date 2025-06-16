<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // middleware globaux (ex: gestion CORS, etc)
    ];

    protected $middlewareGroups = [
        'web' => [
            // middleware web (ex: session, csrf, etc)
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'role' => \App\Http\Middleware\CheckRole::class, // <- ajoute ta ligne ici
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        

        // autres middlewares...
    ];
}
