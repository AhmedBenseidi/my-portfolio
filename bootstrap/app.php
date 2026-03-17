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
        // هذا السطر ضروري جداً لعمل الروابط الموقعة في Railway
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
    //
})
->booting(function () {
    // هذا الكود يضمن حقن المفاتيح في الذاكرة فور تشغيل التطبيق
    $apiKey = env('CLOUDINARY_API_KEY');
    config([
        'cloudinary.cloud.key' => $apiKey,
        'cloudinary.cloud.api_key' => $apiKey,
    ]);
})
->create();
