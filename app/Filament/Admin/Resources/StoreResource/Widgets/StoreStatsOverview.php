<?php

namespace App\Filament\Admin\Resources\StoreResource\Widgets;

use App\Models\Store;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StoreStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalStores = Store::count();
        $productStores = Store::where('type', 'product')->count();
        $serviceStores = Store::where('type', 'service')->count();
        
        $storesThisMonth = Store::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $storesLastMonth = Store::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $percentageChange = $storesLastMonth > 0 
            ? (($storesThisMonth - $storesLastMonth) / $storesLastMonth) * 100 
            : 0;

        return [
            Stat::make('Total Stores', $totalStores)
                ->description('Total stores registered')
                ->descriptionIcon('heroicon-o-building-storefront')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Product Stores', $productStores)
                ->description(round(($totalStores > 0 ? ($productStores / $totalStores) * 100 : 0), 1) . '% of total')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary'),
            
            Stat::make('Service Stores', $serviceStores)
                ->description(round(($totalStores > 0 ? ($serviceStores / $totalStores) * 100 : 0), 1) . '% of total')
                ->descriptionIcon('heroicon-o-wrench-screwdriver')
                ->color('info'),
            
            Stat::make('New This Month', $storesThisMonth)
                ->description(($percentageChange >= 0 ? '+' : '') . round($percentageChange, 1) . '% from last month')
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger')
                ->chart([3, 5, 8, 12, 15, 10, $storesThisMonth]),
        ];
    }
}
