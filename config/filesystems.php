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

        // التعديل هنا: يجب إعطاء الـ Driver كل الإعدادات التي يطلبها
        'cloudinary' => [
            'driver' => 'cloudinary',
            'cloud_url' => env('CLOUDINARY_URL'),
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
                'key'        => env('CLOUDINARY_API_KEY'), // ضروري جداً لتجنب خطأ السطر 30
            ],
            'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
