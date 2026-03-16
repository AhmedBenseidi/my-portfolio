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
        // مشاركة لغة الموقع
        view()->share('isAr', app()->getLocale() === 'ar');

        if (app()->environment('production')) {
            // 1. إجبار استخدام HTTPS لروابط الصور والرفع
            URL::forceScheme('https');

            // 2. استخدام القرص المحلي للرفع المؤقت لضمان الاستقرار
            Config::set('livewire.temporary_file_upload.disk', 'local');

            // 3. تحديد مجلد الرفع المؤقت داخل storage/app
            Config::set('livewire.temporary_file_upload.directory', 'livewire-tmp');
        }
    }
}
