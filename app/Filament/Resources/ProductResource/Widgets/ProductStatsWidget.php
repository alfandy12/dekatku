<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $storeUser = Filament::getTenant()->id;

        $products = Product::where('store_id', $storeUser)->get();

        $totalProducts = $products->count();

        $totalValue = Product::sum('price');
        $avgPrice = Product::avg('price');

        $lastMonthProducts = Product::where('created_at', '>=', now()->subMonth())->count();

        return [
            Stat::make('Total Produk', number_format($totalProducts, 0, ',', '.'))
                ->description('Semua produk di sistem')
                ->descriptionIcon('heroicon-m-square-3-stack-3d')
                ->color('primary')
                ->chart([7, 12, 15, 18, 22, 25, $totalProducts]),

            Stat::make('Total Nilai Produk', 'Rp ' . number_format($totalValue, 0, ',', '.'))
                ->description('Nilai keseluruhan inventori')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Harga Rata-rata', 'Rp ' . number_format($avgPrice, 0, ',', '.'))
                ->description('Per produk')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('info'),

            Stat::make('Produk Bulan Ini', number_format($lastMonthProducts, 0, ',', '.'))
                ->description('30 hari terakhir')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([10, 15, 20, 22, 25, 27, $lastMonthProducts]),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }

    public function getPollingInterval(): ?string
    {
        return '30s';
    }
}
