<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Psy\Readline\Hoa\ConsoleException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $e) {
            return response()->json($e->validator->getMessageBag()->toArray(), $e->status);
        });

        $exceptions->renderable(function (Exception $e) {
            $code = $e->getCode() > 0 ? $e->getCode() : ($e->status ?? 500);
            return response()->json($e->getMessage(), $code);
        });
    })->create();
