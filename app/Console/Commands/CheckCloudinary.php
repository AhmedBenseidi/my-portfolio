<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckCloudinary extends Command
{
    // اسم الأمر الذي ستكتبه في Terminal
    protected $signature = 'check:cloudinary';
    protected $description = 'Check if Cloudinary config is loaded correctly';

    public function handle()
    {
        $this->info('--- Checking Cloudinary Configuration ---');

        $config = config('cloudinary');

        if (!$config) {
            $this->error('❌ Error: config/cloudinary.php file not found or empty.');
            return;
        }

        // التحقق من وجود مفتاح cloud
        if (!isset($config['cloud'])) {
            $this->error('❌ Error: Array key "cloud" is missing from config.');
        } else {
            $this->info('✅ Key "cloud" exists.');

            $cloud = $config['cloud'];
            $this->checkKey('cloud_name', $cloud);
            $this->checkKey('api_key', $cloud);
            $this->checkKey('api_secret', $cloud);

            // تحقق إضافي من مفتاح 'key' الذي تطلبه بعض النسخ
            if (isset($cloud['key'])) {
                $this->info('✅ Key "key" exists (value: ' . substr($cloud['key'], 0, 5) . '***)');
            } else {
                $this->warn('⚠️ Key "key" is missing (might be needed by some Cloudinary versions).');
            }
        }

        $this->info('---------------------------------------');
        $this->info('Final Config Array Structure:');
        dump($config);
    }

    private function checkKey($key, $array)
    {
        if (empty($array[$key])) {
            $this->error("❌ Key '$key' is EMPTY or NULL.");
        } else {
            // إظهار أول 5 أحرف فقط للأمان
            $value = substr($array[$key], 0, 5) . '******';
            $this->info("✅ Key '$key' is set: $value");
        }
    }
}
