<?php

return [
    'cloud_url' => env('CLOUDINARY_URL'),

    'cloud' => [
        'cloud_name' => (string) env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => (string) env('CLOUDINARY_API_KEY'),
        'api_secret' => (string) env('CLOUDINARY_API_SECRET'),
    ],

    // إضافة المفاتيح في المستوى الأول لبعض إصدارات الحزمة التي تطلبها مباشرة
    'api_key'    => (string) env('CLOUDINARY_API_KEY'),
    'api_secret' => (string) env('CLOUDINARY_API_SECRET'),
    'cloud_name' => (string) env('CLOUDINARY_CLOUD_NAME'),
];
