<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
     * Mutator لحقل thumbnail
     * - إذا وصل UploadedFile نخزّنه مؤقتًا في disk public ونخزن المسار.
     * - إذا وصل رابط (http/https) نخزّنه كما هو.
     * - إذا وصل مسار نصي محلي (مثال uploads/projects/xyz.jpg) نخزّنه كما هو.
     */
    public function setThumbnailAttribute($value)
    {
        // حالة: ملف مرفوع مباشرة
        if ($value instanceof UploadedFile) {
            $path = $value->store('uploads/projects', 'public');
            $this->attributes['thumbnail'] = $path;
            return;
        }

        // حالة: رابط كامل من Cloudinary أو أي CDN
        if (is_string($value) && (str_starts_with($value, 'http://') || str_starts_with($value, 'https://'))) {
            $this->attributes['thumbnail'] = $value;
            return;
        }

        // حالة: مسار نصي داخل التخزين العام أو قيمة فارغة
        $this->attributes['thumbnail'] = $value;
    }
}
