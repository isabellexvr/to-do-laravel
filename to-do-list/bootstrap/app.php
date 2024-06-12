<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    commands: __DIR__.'/../routes/console.php',
    using: function () {
        Route::middleware('web')
            ->group(base_path('routes/users.php'));
 
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    },
    health: '/up',
)
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
