<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Message;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي المشاريع', Project::count())
                ->description('المشاريع المضافة في المعرض')
                ->descriptionIcon('heroicon-m-briefcase', IconPosition::Before)
                ->chart([7, 2, 10, 3, 15, 4, 17]) // رسم بياني توضيحي (اختياري)
                ->color('success'),

            Stat::make('المهارات التقنية', Skill::count())
                ->description('التقنيات التي تتقنها')
                ->descriptionIcon('heroicon-m-academic-cap', IconPosition::Before)
                ->color('info'),

            Stat::make('رسائل الزوار', Message::count())
                ->description('إجمالي رسائل التواصل')
                ->descriptionIcon('heroicon-m-envelope', IconPosition::Before)
                ->color('warning'),
        ];
    }
}
