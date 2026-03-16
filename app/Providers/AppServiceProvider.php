<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // مشاركة لغة الموقع
        view()->share('isAr', app()->getLocale() === 'ar');

        // إجبار HTTPS في بيئة الإنتاج لضمان عمل Signed URLs (ضروري للرفع)
        if (app()->environment('production') || config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
