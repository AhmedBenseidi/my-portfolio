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
        // 1. إضافة Middleware اللغة كما كان سابقاً
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // 2. استثناء مسار رفع الملفات من حماية CSRF
        // هذا التعديل ضروري جداً لنجاح رفع الصور إلى Cloudinary عبر Livewire في بيئة Railway
        $middleware->validateCsrfTokens(except: [
            'livewire/upload-file',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
