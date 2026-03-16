<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * تم تنظيف الملف بالكامل من دوال الرفع اليدوي لـ Cloudinary.
     * الاعتماد الآن كلياً على تعريف القرص (cloudinary disk) في الـ Resource.
     */
}
