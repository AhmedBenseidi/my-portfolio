<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'thumbnail',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * قمنا بإزالة الـ Mutator القديم الذي كان يجبر النظام على الرفع لمحلياً (public disk).
     * الآن سيعتمد الموديل على القيمة القادمة من Filament مباشرة.
     */
}
