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
        // 1. الثقة في البروكسي (حل أساسي لمشكلة Method Not Allowed في Railway)
        // هذا السطر يخبر لارفيل أن يثق في الترويسات القادمة من بروكسي Railway
        $middleware->trustProxies(at: '*');

        // 2. إضافة Middleware اللغة كما كان سابقاً
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // 3. استثناء مسارات Livewire من حماية CSRF لضمان استقرار الرفع والتحديث
        $middleware->validateCsrfTokens(except: [
            'livewire/upload-file',
            'livewire/update',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
