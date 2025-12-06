<?php

namespace App\Filament\Admin\Resources\CategoryResource\Widgets;

use App\Models\Categories;
use Filament\Widgets\ChartWidget;

class CategoryStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Category Statistics Overview';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $withProducts = Categories::has('products')->count();
        $emptyCategories = Categories::doesntHave('products')->count();
        $popularCategories = Categories::has('products', '>=', 20)->count();
        $moderateCategories = Categories::has('products', '>=', 5)->has('products', '<', 20)->count();
        $fewProducts = Categories::has('products', '>=', 1)->has('products', '<', 5)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Categories',
                    'data' => [
                        $popularCategories,
                        $moderateCategories,
                        $fewProducts,
                        $emptyCategories,
                    ],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.7)',    // Blue for popular (20+)
                        'rgba(16, 185, 129, 0.7)',    // Green for moderate (5-19)
                        'rgba(245, 158, 11, 0.7)',    // Orange for few (1-4)
                        'rgba(156, 163, 175, 0.7)',   // Gray for empty
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(156, 163, 175)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => [
                'Popular (20+)',
                'Moderate (5-19)',
                'Few (1-4)',
                'Empty (0)',
            ],
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
