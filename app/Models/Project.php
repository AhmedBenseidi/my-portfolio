<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'link',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * دالة اختيارية (Accessor) لضمان الحصول على رابط الصورة كاملاً
     * ستساعدك في عرض الصور في الـ Frontend (الموقع الخارجي)
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return asset('images/placeholder.png'); // صورة افتراضية في حال عدم وجود صورة
        }

        // إذا كانت الصورة مخزنة على كلواديناري، سيعيد الرابط السحابي
        return Storage::disk('cloudinary')->url($this->thumbnail);
    }
}
