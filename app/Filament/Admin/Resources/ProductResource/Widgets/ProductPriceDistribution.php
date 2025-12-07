<?php

namespace App\Filament\Admin\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductPriceDistribution extends ChartWidget
{
    protected static ?string $heading = 'Product Price Distribution';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        // Define price ranges
        $ranges = [
            ['label' => '< Rp 50K', 'min' => 0, 'max' => 50000],
            ['label' => 'Rp 50K - 100K', 'min' => 50000, 'max' => 100000],
            ['label' => 'Rp 100K - 250K', 'min' => 100000, 'max' => 250000],
            ['label' => 'Rp 250K - 500K', 'min' => 250000, 'max' => 500000],
            ['label' => 'Rp 500K - 1M', 'min' => 500000, 'max' => 1000000],
            ['label' => '> Rp 1M', 'min' => 1000000, 'max' => PHP_INT_MAX],
        ];

        $data = [];
        foreach ($ranges as $range) {
            $count = Product::whereBetween('price', [$range['min'], $range['max']])
                ->count();
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Products',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(239, 68, 68)',
                        'rgb(139, 92, 246)',
                        'rgb(236, 72, 153)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => array_column($ranges, 'label'),
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
