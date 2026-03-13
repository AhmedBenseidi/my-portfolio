<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    // أيقونة الرسائل في القائمة الجانبية
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    // الاسم الذي يظهر في القائمة الجانبية
    protected static ?string $navigationLabel = 'الرسائل الواردة';

    /**
     * تعريف شكل عرض الرسالة عند فتحها (View)
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('تفاصيل الرسالة الواردة')
                ->description('بيانات المرسل ومحتوى الرسالة المستلمة من الموقع.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('اسم المرسل')
                            ->disabled(), // للقراءة فقط

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->disabled(),
                    ]),

                    TextInput::make('subject')
                        ->label('الموضوع')
                        ->disabled(),

                    Textarea::make('message') // تم التصحيح ليتطابق مع قاعدة البيانات
                        ->label('محتوى الرسالة')
                        ->rows(8)
                        ->disabled()
                        ->columnSpanFull(),
                ])
        ]);
    }

    /**
     * تعريف الجدول الذي يعرض قائمة الرسائل
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('المرسل')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->copyable() // ميزة لنسخ البريد بضغطة واحدة
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('message') // إظهار لمحة عن الرسالة في الجدول
                    ->label('الرسالة')
                    ->limit(50)
                    ->color('gray')
                    ->tooltip(fn (Message $record): string => $record->message),

                TextColumn::make('created_at')
                    ->label('تاريخ الإرسال')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->color('blue'),
            ])
            ->defaultSort('created_at', 'desc') // عرض الأحدث أولاً
            ->filters([
                // يمكنك إضافة فلاتر هنا لاحقاً
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('عرض')
                    ->color('blue'),
                Tables\Actions\DeleteAction::make()
                    ->label('حذف'),
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
            'index' => Pages\ListMessages::route('/'),
        ];
    }
}
