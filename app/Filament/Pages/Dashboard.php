<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $view = 'filament.pages.dashboard';

    public function getColumns(): int | string | array
    {
        return [
            'default' => 1,
            'sm' => 1,
            'md' => 4,
            'lg' => 4,
            'xl' => 4,
            '2xl' => 4,
        ];
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StoreOverview::class,
            \App\Filament\Widgets\RecentProducts::class,
            \App\Filament\Widgets\CategoryChart::class,
            \App\Filament\Widgets\StoreInfo::class,
            \App\Filament\Widgets\QuickActions::class,
        ];
    }
}
