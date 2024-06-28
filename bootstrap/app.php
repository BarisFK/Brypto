<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware konfigürasyonları burada
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // İstisna (exception) konfigürasyonları burada
    })->create();

    // Uygulama oluşturulduktan sonra middleware'ı tanımlayın
    $app->router->aliasMiddleware('user-access', \App\Http\Middleware\UserAccess::class);

return $app;
