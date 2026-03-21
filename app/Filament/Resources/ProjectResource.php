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
use Illuminate\Support\Arr;

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
                            ->dehydrateStateUsing(function ($state) {
                                // حل المشكلة: تحويل المصفوفة إلى نص إذا كانت مصفوفة
                                $actualState = is_array($state) ? Arr::first($state) : $state;

                                // إذا كان فارغاً أو كان رابطاً جاهزاً (بدءاً بـ http) لا تفعل شيئاً
                                if (! $actualState || (is_string($actualState) && str_starts_with($actualState, 'http'))) {
                                    return $actualState;
                                }

                                $path = storage_path('app/imgbb_temp/' . $actualState);

                                if (file_exists($path)) {
                                    $response = Http::asMultipart()
                                        ->post('https://api.imgbb.com/1/upload?key=' . env('IMGBB_API_KEY'), [
                                            'image' => base64_encode(file_get_contents($path)),
                                        ]);

                                    if ($response->successful()) {
                                        $url = $response->json('data.url');
                                        @unlink($path);
                                        return $url;
                                    }
                                }
                                return $actualState;
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
