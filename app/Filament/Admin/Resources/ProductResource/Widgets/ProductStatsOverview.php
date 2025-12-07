<?php

namespace App\Filament\Admin\Resources\ProductResource\Widgets;

use App\Models\Product;
use App\Models\Store;
use App\Models\Categories;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ProductStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = Product::count();
        $totalStores = Store::count();
        $averageProductsPerStore = $totalStores > 0 ? round($totalProducts / $totalStores, 1) : 0;
        
        $productsThisMonth = Product::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $productsLastMonth = Product::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $percentageChange = $productsLastMonth > 0 
            ? (($productsThisMonth - $productsLastMonth) / $productsLastMonth) * 100 
            : 0;

        $averagePrice = Product::avg('price') ?? 0;
        
        // Get total categories used
        $totalCategories = Categories::has('products')->count();
        $totalCategoriesAll = Categories::count();

        // Get top store by product count
        $topStore = Store::withCount('products')
            ->orderBy('products_count', 'desc')
            ->first();

        return [
            Stat::make('Total Products', number_format($totalProducts))
                ->description('Across all stores')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('success')
                ->chart([7, 12, 15, 18, 22, 25, $totalProducts]),
            
            Stat::make('Average Price', 'Rp ' . number_format($averagePrice, 0, ',', '.'))
                ->description('Average product price')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('primary'),
            
            Stat::make('Active Categories', $totalCategories)
                ->description($totalCategoriesAll . ' total categories available')
                ->descriptionIcon('heroicon-o-tag')
                ->color('warning'),
            
            Stat::make('New This Month', $productsThisMonth)
                ->description(($percentageChange >= 0 ? '+' : '') . round($percentageChange, 1) . '% from last month')
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger')
                ->chart([5, 8, 12, 15, $productsThisMonth]),
            
            Stat::make('Avg per Store', $averageProductsPerStore)
                ->description('Products per store')
                ->descriptionIcon('heroicon-o-building-storefront')
                ->color('info'),
            
            Stat::make('Top Store', $topStore ? $topStore->title : 'N/A')
                ->description($topStore ? $topStore->products_count . ' products' : 'No stores yet')
                ->descriptionIcon('heroicon-o-star')
                ->color('success'),
        ];
    }
}
