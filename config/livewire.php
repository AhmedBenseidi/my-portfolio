<?php

return [
    'class_namespace' => 'App\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'components.layouts.app',
    'lazy_placeholder' => null,

    'temporary_file_upload' => [
    'disk' => 'local', // تأكد أنها local
    'rules' => 'file|mimes:png,jpg,jpeg,gif|max:12288',
    'directory' => 'livewire-tmp',
    'middleware' => ['web'],
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
    'release_token' => null,
];
