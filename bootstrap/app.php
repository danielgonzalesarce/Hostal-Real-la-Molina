<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAdminAuthenticated::class,
            'admin.port' => \App\Http\Middleware\EnsureAdminPort::class,
            'block.admin.public' => \App\Http\Middleware\BlockAdminFromPublicPort::class,
            'security.headers' => \App\Http\Middleware\SecurityHeaders::class,
        ]);
        
        // Middleware global de seguridad (solo en producción)
        if (app()->environment('production')) {
            $middleware->web(append: [
                \App\Http\Middleware\SecurityHeaders::class,
            ]);
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
