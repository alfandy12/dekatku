<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use App\Models\Product;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\ProductStatsWidget;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Produk Baru')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->modalHeading('Tambah Produk Baru')
                ->modalWidth('5xl'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProductStatsWidget::class,
        ];
    }

    public function getTabs(): array
    {

        return [
            'semua' => Tab::make('Semua Produk')
                ->icon('heroicon-o-square-3-stack-3d')
                ->badge(fn() => Product::where('store_id', Filament::getTenant()->id)->count())
                ->badgeColor('primary'),

            'terbaru' => Tab::make('Produk Terbaru')
                ->icon('heroicon-o-sparkles')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subDays(7)))
                ->badge(fn() => Product::where('created_at', '>=', now()->subDays(7))->count())
                ->badgeColor('warning'),

            'harga_tinggi' => Tab::make('Harga Tinggi')
                ->icon('heroicon-o-arrow-trending-up')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('price', '>=', 1000000))
                ->badge(fn() => Product::where('price', '>=', 1000000)->count())
                ->badgeColor('danger'),

            'harga_rendah' => Tab::make('Harga Rendah')
                ->icon('heroicon-o-arrow-trending-down')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('price', '<', 100000))
                ->badge(fn() => Product::where('price', '<', 100000)->count())
                ->badgeColor('info'),
        ];
    }

    public function getTitle(): string
    {
        return 'Manajemen Produk';
    }

    public function getHeading(): string
    {
        return 'Daftar Produk';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola semua produk dari toko Anda di sini';
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Tambahkan widget tambahan di footer jika diperlukan
        ];
    }
}
