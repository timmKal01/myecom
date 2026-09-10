<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleManager;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Azure App Service (and similar platforms) terminate TLS at their
        // edge and forward plain HTTP internally, only telling us the
        // original scheme via X-Forwarded-Proto. Without trusting that,
        // Laravel generates http:// asset/URL links on an https:// page,
        // which browsers block as mixed content.
        $middleware->trustProxies(at: '*');

        $middleware->alias(['rolemanager' => RoleManager::class
    ]);
        // Apple posts its Sign In callback cross-site (form_post response mode),
        // so it can't carry our CSRF token.
        $middleware->validateCsrfTokens(except: [
            'auth/apple/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
