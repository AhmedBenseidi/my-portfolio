<?php

/*
 * This file is part of the Laravel Cloudinary package.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | رابط التنبيهات (Webhooks) عند إتمام عمليات الرفع أو الحذف.
    |
    */
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),

    /*
    |--------------------------------------------------------------------------
    | Cloudinary URL Configuration
    |--------------------------------------------------------------------------
    |
    | هذا هو الإعداد الأهم. قمت بتعديل الـ Fallback ليتوافق مع أسماء المتغيرات
    | التي تستخدمها في Railway (API_KEY و API_SECRET).
    |
    */
    'cloud_url' => env('CLOUDINARY_URL', 'cloudinary://'.env('CLOUDINARY_API_KEY').':'.env('CLOUDINARY_API_SECRET').'@'.env('CLOUDINARY_CLOUD_NAME')),

    /**
     * Upload Preset From Cloudinary Dashboard
     * * تنبيه: إذا واجهت مشكلة "Failed to upload"، جرب ترك هذا المتغير فارغاً
     * في Railway أو تأكد أنه "Unsigned" في لوحة تحكم كلواديناري.
     */
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),

    /**
     * المسارات والعمليات الخاصة بـ Blade Upload Widget
     */
    'upload_route'  => env('CLOUDINARY_UPLOAD_ROUTE'),
    'upload_action' => env('CLOUDINARY_UPLOAD_ACTION'),
];
