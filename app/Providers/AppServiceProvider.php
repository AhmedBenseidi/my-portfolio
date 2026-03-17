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
        }

        // إعدادات الرفع لـ Livewire فقط
        Config::set('livewire.temporary_file_upload.disk', 'local');
    }
}
