<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/local'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'imgbb_temp' => [
            'driver' => 'local',
            'root' => storage_path('app/imgbb_temp'),
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
