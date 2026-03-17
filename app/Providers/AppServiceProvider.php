<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        view()->share('isAr', app()->getLocale() === 'ar');

        if (app()->environment('production')) {
            URL::forceScheme('https');

            // تأكيد إضافي للمفاتيح
            Config::set('cloudinary.cloud.key', env('CLOUDINARY_API_KEY'));
        }

        // إعدادات الرفع لـ Livewire
        Config::set('livewire.temporary_file_upload.disk', 'local');
    }
}
