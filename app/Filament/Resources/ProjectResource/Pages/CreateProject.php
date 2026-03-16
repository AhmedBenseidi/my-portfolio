<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    /**
     * تم حذف جميع دوال الرفع اليدوي.
     * بما أننا ضبطنا حقل FileUpload في الـ Resource ليستخدم disk('cloudinary')،
     * فإن Filament سيتكفل بالرفع تلقائياً وحفظ الرابط في قاعدة البيانات.
     */
}
