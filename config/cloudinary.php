<?php

return [
    'cloud_url' => env('CLOUDINARY_URL'),

    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        // المفاتيح التي تسبب المشكلة في السيرفر
        'key'        => env('CLOUDINARY_API_KEY'),
        'secret'     => env('CLOUDINARY_API_SECRET'),
    ],

    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
];
