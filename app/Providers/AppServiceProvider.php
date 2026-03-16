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

        if (app()->environment('production') || config('app.env') === 'production') {
            // 1. إجبار استخدام HTTPS لروابط الصور والرفع لضمان الأمان
            URL::forceScheme('https');

            // 2. حل جذري: حقن إعدادات Cloudinary يدوياً لضمان وجود مفتاح "cloud" و "key"
            Config::set('cloudinary.cloud.cloud_name', env('CLOUDINARY_CLOUD_NAME'));
            Config::set('cloudinary.cloud.api_key', env('CLOUDINARY_API_KEY'));
            Config::set('cloudinary.cloud.api_secret', env('CLOUDINARY_API_SECRET'));

            // احتياط إضافي لبعض نسخ الحزمة التي تبحث عن كلمة "key" مباشرة
            Config::set('cloudinary.cloud.key', env('CLOUDINARY_API_KEY'));

            // 3. ضبط القرص المحلي للرفع المؤقت لضمان استقرار Livewire
            Config::set('livewire.temporary_file_upload.disk', 'local');
            Config::set('livewire.temporary_file_upload.directory', 'livewire-tmp');
        }
    }
}
