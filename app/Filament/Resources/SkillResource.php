<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'المهارات التقنية';
    protected static ?string $modelLabel = 'مهارة';
    protected static ?string $pluralModelLabel = 'المهارات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('تفاصيل المهارة')
                ->description('قم بتنظيم مهاراتك حسب التصنيف والألوان لتظهر بشكل متناسق في الموقع')
                ->schema([
                    TextInput::make('name')
                        ->label('اسم المهارة')
                        ->required()
                        ->placeholder('مثلاً: Laravel'),

                    Select::make('category')
                        ->label('التصنيف')
                        ->options([
                            'Backend' => 'Backend',
                            'Frontend' => 'Frontend',
                            'Tools' => 'Tools',
                            'Mobile' => 'Mobile',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('icon')
                        ->label('كلاس الأيقونة (FontAwesome)')
                        ->placeholder('مثلاً: fab fa-laravel')
                        ->required()
                        ->helperText('استخدم كلاسات FontAwesome مثل: fas fa-server'),

                    ColorPicker::make('color')
                        ->label('اللون التعريفي')
                        ->default('#2563eb')
                        ->required(),

                    TextInput::make('proficiency')
                        ->label('نسبة الإتقان')
                        ->numeric()
                        ->suffix('%')
                        ->default(100)
                        ->minValue(1)
                        ->maxValue(100),
                ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('التصنيف')
                    ->badge() // يظهر التصنيف على شكل بطاقة ملونة
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('icon')
                    ->label('الأيقونة')
                    ->copyable() // ميزة نسخ الكلاس عند الضغط عليه
                    ->icon(fn (string $state): string => 'heroicon-o-code-bracket'),

                ColorColumn::make('color')
                    ->label('اللون'),

                TextColumn::make('proficiency')
                    ->label('الإتقان')
                    ->suffix('%')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('فلترة حسب التصنيف')
                    ->options([
                        'Backend' => 'Backend',
                        'Frontend' => 'Frontend',
                        'Tools' => 'Tools',
                    ]),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
