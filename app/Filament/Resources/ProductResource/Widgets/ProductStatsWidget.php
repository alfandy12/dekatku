<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = Product::count();

        return [
            Stat::make('Total Products', $totalProducts)
                ->description('All products in your store')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('primary'),
        ];
    }
}
