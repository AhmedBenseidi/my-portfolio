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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booting(function () {
        // حقن القيم مباشرة في الذاكرة لتجنب خطأ التوقيت في التحميل
        $key = env('CLOUDINARY_API_KEY');
        $secret = env('CLOUDINARY_API_SECRET');

        config([
            'cloudinary.cloud.key' => $key,
            'cloudinary.cloud.secret' => $secret,
            'cloudinary.cloud.api_key' => $key,
            'cloudinary.cloud.api_secret' => $secret,
        ]);
    })
    ->create();
