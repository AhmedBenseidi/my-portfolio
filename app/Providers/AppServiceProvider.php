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
        // مشاركة متغير اللغة مع جميع القوالب (Blade Views)
        view()->share('isAr', app()->getLocale() === 'ar');

        // إعدادات خاصة ببيئة الإنتاج (Production) على Railway
        if (app()->environment('production')) {

            // 1. إجبار النظام على استخدام HTTPS
            // هذا ضروري جداً لضمان عمل روابط الصور والملفات بشكل آمن
            URL::forceScheme('https');

            // 2. ضبط قرص التخزين المؤقت لـ Livewire
            // نقوم بضبطه برمجياً هنا لضمان تخطي أي كاش (Cache) قديم
            Config::set('livewire.temporary_file_upload.disk', 'cloudinary');

            // 3. تحديد مجلد المرفقات المؤقتة داخل Cloudinary
            Config::set('livewire.temporary_file_upload.directory', 'livewire-tmp');

            // 4. ضبط وقت انتهاء صلاحية الروابط المؤقتة (اختياري لزيادة الأمان)
            Config::set('livewire.temporary_file_upload.rules', 'file|mimes:png,jpg,jpeg,gif|max:12288');
        }
    }
}
