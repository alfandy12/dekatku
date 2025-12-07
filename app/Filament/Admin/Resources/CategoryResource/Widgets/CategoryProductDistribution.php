<?php

namespace App\Filament\Admin\Resources\CategoryResource\Widgets;

use App\Models\Categories;
use Filament\Widgets\ChartWidget;

class CategoryProductDistribution extends ChartWidget
{
    protected static ?string $heading = 'Product Distribution by Category';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        // Get top 10 categories with most products
        $categories = Categories::withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(10)
            ->get();

        // Generate colors dynamically
        $colors = [
            'rgb(59, 130, 246)',
            'rgb(16, 185, 129)',
            'rgb(245, 158, 11)',
            'rgb(239, 68, 68)',
            'rgb(139, 92, 246)',
            'rgb(236, 72, 153)',
            'rgb(6, 182, 212)',
            'rgb(132, 204, 22)',
            'rgb(251, 146, 60)',
            'rgb(168, 85, 247)',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $categories->count()),
                    'borderColor' => array_slice($colors, 0, $categories->count()),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
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
