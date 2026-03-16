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

            // حقن الإعدادات برمجياً لضمان وجود مفتاح "cloud" ومفتاح "key"
            // هذا الحل يمنع خطأ Undefined array key "key" نهائياً
            Config::set('cloudinary.cloud', [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
                'key'        => env('CLOUDINARY_API_KEY'), // إضافة 'key' كاحتياط لبعض نسخ الحزمة
            ]);

            // إعدادات الرفع لـ Livewire
            Config::set('livewire.temporary_file_upload.disk', 'local');
        }
    }
}
