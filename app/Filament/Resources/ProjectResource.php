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
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Http;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'المشاريع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('معلومات المشروع')
                    ->schema([
                        TextInput::make('title')->label('العنوان')->required(),
                        TextInput::make('link')->label('رابط المشروع')->url(),
                        Textarea::make('description')->label('الوصف')->required()->columnSpanFull(),

                        FileUpload::make('thumbnail')
                            ->label('صورة المشروع')
                            ->image()
                            ->disk('imgbb_temp')
                            ->directory('uploads')
                            ->required()
                            // هذا هو الجزء الذي كان ينقصك: تحويل المسار لرابط قبل الحفظ
                            ->dehydrateStateUsing(function ($state) {
                                if (! $state || str_starts_with($state, 'http')) {
                                    return $state;
                                }

                                $path = storage_path('app/imgbb_temp/' . $state);

                                if (file_exists($path)) {
                                    $response = Http::asMultipart()
                                        ->post('https://api.imgbb.com/1/upload?key=' . env('IMGBB_API_KEY'), [
                                            'image' => base64_encode(file_get_contents($path)),
                                        ]);

                                    if ($response->successful()) {
                                        $url = $response->json('data.url');
                                        @unlink($path); // حذف الملف المؤقت
                                        return $url; // سيتم حفظ الرابط بدلاً من المسار المحلي
                                    }
                                }
                                return $state;
                            }),

                        TagsInput::make('tags')->label('التقنيات')->separator(','),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('الصورة')
                    ->circular(),
                TextColumn::make('title')->label('العنوان')->searchable(),
                TextColumn::make('tags')->label('التقنيات')->badge(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
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
