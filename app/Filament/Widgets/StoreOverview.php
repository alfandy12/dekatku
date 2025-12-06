<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Categories;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StoreOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $storeId = Filament::getTenant()->id;

        $products = Product::where('store_id', $storeId)->get();

        $totalProducts = $products->count();

        $totalCategories = Categories::whereHas('products', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->count();

        return [
            Stat::make('Total Produk', $totalProducts)
                ->description('Produk aktif di toko')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success')
                ->chart([12, 15, 18, 20, 22, 25, 27]),

            Stat::make('Kategori', $totalCategories)
                ->description('Kategori produk')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),

            Stat::make('Produk Terbaru', $this->getNewProducts($storeId))
                ->description('Ditambahkan bulan ini')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),
        ];
    }

    protected function getNewProducts($storeId): int
    {
        return Product::where('store_id', $storeId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    public function getColumns(): int
    {
        return 3;
    }
}
