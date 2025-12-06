<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use App\Filament\Admin\Resources\ProductResource\Widgets\ProductStatsOverview;
use App\Filament\Admin\Resources\ProductResource\Widgets\ProductsByStoreChart;
use App\Filament\Admin\Resources\ProductResource\Widgets\ProductPriceDistribution;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProductStatsOverview::class,
            ProductsByStoreChart::class,
            ProductPriceDistribution::class,
        ];
    }
}
