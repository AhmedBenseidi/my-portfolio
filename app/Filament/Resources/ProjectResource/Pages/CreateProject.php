<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            // 1) حالة: الملف أُرسل مباشرة في الطلب (UploadedFile)
            if (request()->hasFile('thumbnail')) {
                $file = request()->file('thumbnail');

                if ($file instanceof UploadedFile) {
                    $secureUrl = $this->uploadToCloudinaryFromUploadedFile($file);
                    if ($secureUrl) {
                        $data['thumbnail'] = $secureUrl;
                    }
                }
            }
            // 2) حالة: Filament FileUpload أعاد مسارًا نصيًا داخل التخزين العام (مثال: "uploads/projects/xyz.jpg")
            elseif (!empty($data['thumbnail']) && is_string($data['thumbnail'])) {
                $localPath = $data['thumbnail'];

                // إذا المسار يحتوي على "http" فربما هو رابط بالفعل، لا نفعل شيء
                if (!str_starts_with($localPath, 'http')) {
                    // نحصل على المسار الكامل في disk public
                    if (Storage::disk('public')->exists($localPath)) {
                        $fullPath = Storage::disk('public')->path($localPath);
                        $secureUrl = $this->uploadToCloudinaryFromLocalPath($fullPath);
                        if ($secureUrl) {
                            $data['thumbnail'] = $secureUrl;

                            // نحذف الملف المحلي المؤقت بعد الرفع
                            Storage::disk('public')->delete($localPath);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // لا نكسر العملية؛ نسجل الخطأ للمراجعة
            Log::error('CreateProject thumbnail upload error: ' . $e->getMessage());
        }

        return $data;
    }

    /**
     * Upload an UploadedFile instance to Cloudinary and return secure_url or null.
     */
    protected function uploadToCloudinaryFromUploadedFile(UploadedFile $file): ?string
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $result = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            ['folder' => 'projects']
        );

        return $result['secure_url'] ?? null;
    }

    /**
     * Upload a local file path to Cloudinary and return secure_url or null.
     */
    protected function uploadToCloudinaryFromLocalPath(string $path): ?string
    {
        if (!file_exists($path)) {
            return null;
        }

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $result = $cloudinary->uploadApi()->upload(
            $path,
            ['folder' => 'projects']
        );

        return $result['secure_url'] ?? null;
    }
}
