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
        // مشاركة متغير اللغة
        view()->share('isAr', app()->getLocale() == 'ar');

        if (app()->environment('production')) {
            // 1. إجبار HTTPS لحل مشكلة التنسيقات
            URL::forceScheme('https');

            // 2. إجبار Livewire على استخدام Cloudinary للرفع المؤقت
            Config::set('livewire.temporary_file_upload.disk', 'cloudinary');

            // 3. تحديد المجلد المؤقت في كلواديناري
            Config::set('livewire.temporary_file_upload.directory', 'livewire-tmp');
        }
    }
}
