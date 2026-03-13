<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * معالجة الطلب الوارد وتحديد اللغة.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // جلب اللغة من الجلسة (Session) أو استخدام اللغة الافتراضية من ملف الإعدادات
        $locale = session('locale', config('app.locale'));

        // ضبط لغة التطبيق بناءً على القيمة المحضرة
        App::setLocale($locale);

        return $next($request);
    }
}
