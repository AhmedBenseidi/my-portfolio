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
        // 1. الثقة في البروكسي (حل مشكلة التوقيع Signed URL في Railway)
        $middleware->trustProxies(at: '*');

        // 2. إضافة Middleware اللغة
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // 3. استثناء مسار الرفع من CSRF لضمان عدم رفض الطلب
        $middleware->validateCsrfTokens(except: [
            'livewire/upload-file',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
