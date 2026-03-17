<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Config;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // هذا السطر هو الحل لمشكلة تحميل الصور في Railway
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booting(function () {
        $apiKey = env('CLOUDINARY_API_KEY');
        config([
            'cloudinary.cloud.key' => $apiKey,
            'cloudinary.cloud.api_key' => $apiKey,
            'cloudinary.cloud.cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'cloudinary.cloud.api_secret' => env('CLOUDINARY_API_SECRET'),
        ]);
    })
    ->create();
