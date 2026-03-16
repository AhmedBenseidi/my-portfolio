<?php

return [

    // نعتمد على local كافتراضي للتخزين المؤقت، بينما نستخدم cloudinary للمشاريع
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

        // تعريف قرص Cloudinary
        'cloudinary' => [
            'driver' => 'cloudinary',
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key' => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
