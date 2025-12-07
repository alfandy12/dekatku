<?php

namespace App\Filament\Admin\Resources\StoreResource\Widgets;

use App\Models\Store;
use Filament\Widgets\ChartWidget;

class StoreTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Store Type Distribution';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $productCount = Store::where('type', 'product')->count();
        $serviceCount = Store::where('type', 'service')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Store Types',
                    'data' => [$productCount, $serviceCount],
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                    ],
                    'borderColor' => [
                        'rgb(37, 99, 235)',
                        'rgb(5, 150, 105)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Product Stores', 'Service Stores'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
