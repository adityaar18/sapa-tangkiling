<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate as FrameworkAuthenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as FrameworkRedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            // auth & guest pakai middleware dari Illuminate\Auth\Middleware\*
            'auth'  => FrameworkAuthenticate::class,
            'guest' => FrameworkRedirectIfAuthenticated::class,

            // alias role milik kamu sendiri (kalau pakai pemisahan admin/user)
            'role'  => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // (opsional) atur redirect default untuk tamu yang coba akses halaman proteksi:
        $middleware->redirectGuestsTo(fn() => route('login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
