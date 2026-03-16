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

                        // الحل الجذري: الرفع مباشرة إلى Cloudinary لتجنب مشاكل الصلاحيات في Railway
                        FileUpload::make('thumbnail')
                            ->label('صورة المشروع')
                            ->image()
                            ->disk('cloudinary') // تغيير القرص إلى cloudinary
                            ->directory('projects')
                            ->visibility('public')
                            ->maxSize(5120) // رفع الحد لـ 5 ميجا لضمان الراحة في الرفع
                            ->imagePreviewHeight(120)
                            ->required(),

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
                        $value = $record->thumbnail;
                        if (!$value) return null;

                        // إذا كان الرابط يبدأ بـ http، نعرضه كما هو (رابط Cloudinary)
                        if (is_string($value) && (str_starts_with($value, 'http://') || str_starts_with($value, 'https://'))) {
                            return $value;
                        }

                        // في حال وجود صور قديمة مخزنة محلياً
                        return asset('storage/' . ltrim($value, '/'));
                    })
                    ->rounded(),

                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tags')
                    ->label('التقنيات')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->toggleable(),

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
