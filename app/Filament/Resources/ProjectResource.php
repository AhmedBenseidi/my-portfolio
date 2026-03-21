<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'المشاريع';
    protected static ?string $modelLabel = 'مشروع';
    protected static ?string $pluralModelLabel = 'المشاريع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('تفاصيل المشروع')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان المشروع')
                            ->required(),

                        TextInput::make('link')
                            ->label('رابط المشروع')
                            ->url()
                            ->nullable(),

                        Textarea::make('description')
                            ->label('الوصف')
                            ->required()
                            ->columnSpanFull(),

                        // التعديل الجذري للرفع إلى ImgBB
                        FileUpload::make('thumbnail')
                            ->label('صورة المشروع')
                            ->image()
                            // نستخدم التخزين المحلي كجسر مؤقت للرفع
                            ->disk('local')
                            ->directory('temp-projects')
                            ->imagePreviewHeight(120)
                            ->required()
                            // دالة المعالجة قبل الحفظ في قاعدة البيانات
                            ->saveRelationshipsUsing(static function ($component, $state, $record) {
                                if (! $state) return;

                                try {
                                    // الحصول على مسار الملف المؤقت في الحاوية
                                    $filePath = storage_path('app/local/' . $state);

                                    if (file_exists($filePath)) {
                                        // الرفع إلى ImgBB API
                                        $response = Http::asMultipart()
                                            ->post('https://api.imgbb.com/1/upload?key=' . env('IMGBB_API_KEY'), [
                                                'image' => base64_encode(file_get_contents($filePath)),
                                            ]);

                                        if ($response->successful()) {
                                            $remoteUrl = $response->json('data.url');

                                            // تحديث السجل برابط الصورة المباشر
                                            $record->update(['thumbnail' => $remoteUrl]);

                                            // حذف الملف المؤقت لتوفير المساحة في Railway
                                            @unlink($filePath);
                                        } else {
                                            Log::error('ImgBB Upload Failed: ' . $response->body());
                                        }
                                    }
                                } catch (\Exception $e) {
                                    Log::error('ImgBB Integration Error: ' . $e->getMessage());
                                }
                            }),

                        TagsInput::make('tags')
                            ->label('التقنيات المستخدمة')
                            ->placeholder('أضف تقنية ثم اضغط Enter')
                            ->separator(',')
                            ->hint('يمكن إضافة عدة تقنيات'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('الصورة')
                    ->getStateUsing(function ($record) {
                        // بما أننا نخزن الرابط كاملاً، نعيده كما هو
                        return $record->thumbnail;
                    })
                    ->circular(),

                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tags')
                    ->label('التقنيات')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
