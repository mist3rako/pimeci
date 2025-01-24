<?php

use App\Http\Middleware\Role;
use App\Http\Middleware\CheckDirection; // Assurez-vous d'importer le middleware
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Utilisation de l'alias pour les middlewares
        $middleware->alias([
            'role' => Role::class,
            'check.direction' => CheckDirection::class, // Ajoutez cette ligne pour CheckDirection
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
