<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use Filament\Widgets\ChartWidget;

class MessagesChart extends ChartWidget
{
    protected static ?string $heading = 'نشاط الرسائل الواردة';
    protected static ?int $sort = 2; // ليظهر تحت الإحصائيات مباشرة

    protected function getData(): array
    {
        // جلب البيانات من قاعدة البيانات (تجميع الرسائل حسب الشهر)
        $data = Message::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->all();

        // تجهيز مصفوفة لـ 12 شهراً لضمان ظهور الشهور الفارغة بصفر
        $fullYearData = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullYearData[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'الرسائل',
                    'data' => $fullYearData,
                    'fill' => 'start',
                    'borderColor' => '#fbbf24', // لون Amber مميز
                    'backgroundColor' => 'rgba(251, 191, 36, 0.1)',
                    'tension' => 0.4, // لجعل الخط منحنياً بشكل سينمائي ناعم
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // نوع المخطط (خطي)
    }
}
