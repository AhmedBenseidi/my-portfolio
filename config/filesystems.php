<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

'disks' => [
    // ... الأقراص الأخرى
    'imgbb' => [
        'driver' => 'imgbb',
        'key' => env('IMGBB_API_KEY'),
    ],
],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
