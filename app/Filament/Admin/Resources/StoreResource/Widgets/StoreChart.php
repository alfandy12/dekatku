<?php

namespace App\Filament\Admin\Resources\StoreResource\Widgets;

use App\Models\Store;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StoreChart extends ChartWidget
{
    protected static ?string $heading = 'Store Registration Trend';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $data = collect();

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Store::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $data->push([
                'month' => $date->format('M Y'),
                'count' => $count,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Stores registered',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
