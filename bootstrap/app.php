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
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booting(function () {
        // حقن الإعدادات في الذاكرة فوراً عند إقلاع التطبيق
        $apiKey = env('CLOUDINARY_API_KEY');

        Config::set('cloudinary.cloud.key', $apiKey);
        Config::set('cloudinary.cloud.api_key', $apiKey);
        Config::set('cloudinary.cloud.cloud_name', env('CLOUDINARY_CLOUD_NAME'));
        Config::set('cloudinary.cloud.api_secret', env('CLOUDINARY_API_SECRET'));
    })
    ->create();
