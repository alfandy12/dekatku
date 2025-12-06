<?php

namespace App\Filament\Admin\Resources\StoreResource\Pages;

use App\Filament\Admin\Resources\StoreResource;
use App\Filament\Admin\Resources\StoreResource\Widgets\StoreStatsOverview;
use App\Filament\Admin\Resources\StoreResource\Widgets\StoreChart;
use App\Filament\Admin\Resources\StoreResource\Widgets\StoreTypeChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStores extends ListRecords
{
    protected static string $resource = StoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StoreStatsOverview::class,
            StoreChart::class,
            StoreTypeChart::class,
        ];
    }
}
