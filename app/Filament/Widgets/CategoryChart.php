<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Categories;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Produk per Kategori';

    protected static ?string $description = 'Jumlah produk di setiap kategori';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $storeUser = Filament::getTenant()->id;

        $products = Product::where('store_id', $storeUser)->get();

        $totalProducts = $products->count();

        $categories = Categories::withCount('products')
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->limit(8)
            ->get();

        if ($categories->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Produk',
                        'data' => [0],
                        'backgroundColor' => ['rgba(156, 163, 175, 0.5)'],
                    ],
                ],
                'labels' => ['Belum ada data'],
            ];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(20, 184, 166, 0.8)',
                        'rgba(250, 204, 21, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(251, 146, 60)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)',
                        'rgb(20, 184, 166)',
                        'rgb(250, 204, 21)',
                        'rgb(239, 68, 68)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
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
