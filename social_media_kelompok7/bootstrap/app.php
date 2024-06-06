<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Middleware; // Update this line

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) { // Remove the type hint
        // You can use the $middleware object here
    })
    ->withExceptions(function ($exceptions) {
        //
    })->create();


$app = new Application(
    realpath(__DIR__.'/../')
);

$app->bind('path.public', function ($app) {
    return __DIR__.'/../public';
});

return $app;