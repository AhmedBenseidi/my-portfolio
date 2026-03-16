<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
            'cloudinary' => [
                 'driver' => 'cloudinary',
                 'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                 'api_key' => env('CLOUDINARY_API_KEY'),
                 'api_secret' => env('CLOUDINARY_API_SECRET'),
                 // دمج مصفوفة cloud هنا ضروري جداً لتجاوز أخطاء الحزمة في الإنتاج
                 'cloud' => [
                     'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                     'api_key'    => env('CLOUDINARY_API_KEY'),
                     'api_secret' => env('CLOUDINARY_API_SECRET'),
                     'key'        => env('CLOUDINARY_API_KEY'), // حماية إضافية
    ],
],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
