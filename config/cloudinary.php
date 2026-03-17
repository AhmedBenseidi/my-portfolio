<?php

return [
    'cloud_url' => env('CLOUDINARY_URL'),

    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        // إضافة المفاتيح التي تبحث عنها الحزمة يدوياً
        'key'        => env('CLOUDINARY_API_KEY'),
        'secret'     => env('CLOUDINARY_API_SECRET'),
    ],

    // تكرارها في المستوى الأول لضمان الوصول إليها
    'api_key'    => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
];
