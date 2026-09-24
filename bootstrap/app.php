<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    ->withRouting(

        web: __DIR__ . '/../routes/web.php',

        api: __DIR__ . '/../routes/api.php',

        commands: __DIR__ . '/../routes/console.php',

        health: '/up',

    )


    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        | Middleware untuk membatasi halaman Admin.
        |
        | Route yang menggunakan:
        |
        | ->middleware('admin')
        |
        | akan diperiksa oleh AdminMiddleware.
        */

        $middleware->alias([

            'admin' => \App\Http\Middleware\AdminMiddleware::class,

        ]);

    })


    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions): void {

        /*
        | API akan mengembalikan response JSON
        | ketika request berasal dari /api/*
        | atau request memang mengharapkan JSON.
        */

        $exceptions->shouldRenderJsonWhen(

            fn (Request $request) =>
                $request->is('api/*') ||
                $request->expectsJson(),

        );

    })


    /*
    |--------------------------------------------------------------------------
    | Create Application
    |--------------------------------------------------------------------------
    */

    ->create();