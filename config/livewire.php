<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Class Namespace
    |---------------------------------------------------------------------------
    */
    'class_namespace' => 'App\\Livewire',

    /*
    |---------------------------------------------------------------------------
    | View Path
    |---------------------------------------------------------------------------
    */
    'view_path' => resource_path('views/livewire'),

    /*
    |---------------------------------------------------------------------------
    | Layout
    |---------------------------------------------------------------------------
    */
    'layout' => 'components.layouts.app',

    'lazy_placeholder' => null,

    /*
    |---------------------------------------------------------------------------
    | Temporary File Uploads
    |---------------------------------------------------------------------------
    | إعدادات الرفع المؤقت - تم التأكد من توجيهها لـ Cloudinary
    */
    'temporary_file_upload' => [
        'disk' => 'cloudinary',
        'rules' => 'file|mimes:png,jpg,jpeg,gif|max:12288', // 12MB كحد أقصى
        'directory' => 'livewire-tmp',
        'middleware' => 'web', // أضفنا هذا السطر لضمان مرور الطلب عبر جلسة العمل (Session)
    ],

    'render_on_redirect' => false,

    'legacy_model_binding' => false,

    'inject_assets' => true,

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],

    'inject_morph_markers' => true,

    'smart_wire_keys' => false,

    'pagination_theme' => 'tailwind',

    /*
    |---------------------------------------------------------------------------
    | Release Token
    |---------------------------------------------------------------------------
    */
    'release_token' => null, // يُفضل تركه null ليتم توليده تلقائياً أو وضع قيمة ثابتة
];
