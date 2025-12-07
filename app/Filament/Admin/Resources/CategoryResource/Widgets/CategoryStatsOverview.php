<?php

namespace App\Filament\Admin\Resources\CategoryResource\Widgets;

use App\Models\Categories;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class CategoryStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCategories = Categories::count();
        
        // Categories with products
        $categoriesWithProducts = Categories::has('products')->count();
        $emptyCategoriesCount = $totalCategories - $categoriesWithProducts;
        
        // Average products per category
        $avgProductsPerCategory = $categoriesWithProducts > 0 
            ? round(Product::count() / $categoriesWithProducts, 1) 
            : 0;
        
        // Most used category
        $topCategory = Categories::withCount('products')
            ->orderBy('products_count', 'desc')
            ->first();
        
        // Categories this month
        $categoriesThisMonth = Categories::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $categoriesLastMonth = Categories::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $percentageChange = $categoriesLastMonth > 0 
            ? (($categoriesThisMonth - $categoriesLastMonth) / $categoriesLastMonth) * 100 
            : 0;

        // Popular categories (20+ products)
        $popularCategories = Categories::has('products', '>=', 20)->count();

        return [
            Stat::make('Total Categories', $totalCategories)
                ->description($categoriesWithProducts . ' with products')
                ->descriptionIcon('heroicon-o-tag')
                ->color('success')
                ->chart([3, 5, 8, 12, 15, 18, $totalCategories]),
            
            Stat::make('With Products', $categoriesWithProducts)
                ->description($emptyCategoriesCount . ' empty categories')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary'),
            
            Stat::make('Avg Products', $avgProductsPerCategory)
                ->description('Per active category')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
            
            Stat::make('Top Category', $topCategory ? $topCategory->name : 'N/A')
                ->description($topCategory ? $topCategory->products_count . ' products' : 'No categories yet')
                ->descriptionIcon('heroicon-o-fire')
                ->color('success'),
            
            Stat::make('Popular Categories', $popularCategories)
                ->description('With 20+ products')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning'),
            
            Stat::make('New This Month', $categoriesThisMonth)
                ->description(($percentageChange >= 0 ? '+' : '') . round($percentageChange, 1) . '% from last month')
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger')
                ->chart([2, 4, 6, 8, $categoriesThisMonth]),
        ];
    }
}
