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
     * دالة مساعدة للتأكد من الحصول على رابط الصورة بشكل صحيح دائماً
     */
    public function getImageUrlAttribute()
    {
        if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }
}
