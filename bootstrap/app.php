<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isSuperAdmin' => \App\Http\Middleware\IsSuperAdmin::class,
            'isCustomer' => \App\Http\Middleware\IsCustomer::class,
        ]);

        $middleware->redirectGuestsTo(fn(Request $request) => route('login'));

        $middleware->validateCsrfTokens(except: [
            'fonnte/webhook'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
