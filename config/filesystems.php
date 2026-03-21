<?php

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/local'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        // أضف هذا الجزء إذا لم يكن موجوداً بدقة
        'imgbb_temp' => [
            'driver' => 'local',
            'root' => storage_path('app/imgbb_temp'),
        ],
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
