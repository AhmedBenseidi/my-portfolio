<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // مشاركة متغير اللغة مع جميع القوالب
        view()->share('isAr', app()->getLocale() == 'ar');

        // إعدادات بيئة الإنتاج (Production) على Railway
        if (app()->environment('production')) {
            // 1. إجبار استخدام HTTPS لحل مشكلة التنسيقات (CSS)
            URL::forceScheme('https');

            // 2. إجبار Livewire على استخدام Cloudinary للملفات المؤقتة
            // هذا سيحل خطأ "failed to upload" الذي يظهر لك في Filament
            Config::set('livewire.temporary_file_upload.disk', 'cloudinary');
        }
    }
}
