<?php

namespace App\Filament\Admin\Resources\CategoryResource\Pages;

use App\Filament\Admin\Resources\CategoryResource;
use App\Filament\Admin\Resources\CategoryResource\Widgets\CategoryStatsOverview;
use App\Filament\Admin\Resources\CategoryResource\Widgets\CategoryProductDistribution;
use App\Filament\Admin\Resources\CategoryResource\Widgets\CategoryStatusChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CategoryStatsOverview::class,
            CategoryProductDistribution::class,
            CategoryStatusChart::class,
        ];
    }
}
