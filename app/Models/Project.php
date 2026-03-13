<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
