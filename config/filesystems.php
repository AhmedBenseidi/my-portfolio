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
        'cloud_url' => env('CLOUDINARY_URL'),

        // الحزمة تبحث داخل مصفوفة cloud عن هذه المفاتيح
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
            'key'        => env('CLOUDINARY_API_KEY'),    // لسطر 30 في الحزمة
            'secret'     => env('CLOUDINARY_API_SECRET'), // لسطر 31 في الحزمة (الخطأ الحالي)
        ],

        // احتياط إضافي في حال بحثت الحزمة في المستوى الأول
        'key'    => env('CLOUDINARY_API_KEY'),
        'secret' => env('CLOUDINARY_API_SECRET'),

        'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
