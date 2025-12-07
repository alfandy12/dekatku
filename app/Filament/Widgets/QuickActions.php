<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Facades\Filament;
use App\Filament\Resources\ProductResource;

class QuickActions extends Widget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.quick-actions';

    public function getActions(): array
    {
        $tenant = Filament::getTenant();

        return [
            [
                'label' => 'Tambah Produk',
                'icon' => 'heroicon-o-plus-circle',
                'url' => route('filament.console.resources.products.create', ['tenant' => $tenant?->slug ?? '']),
                'color' => 'success',
                'description' => 'Tambahkan produk baru ke toko',
            ],
            [
                'label' => 'Product Saya',
                'icon' => 'heroicon-o-plus-circle',
                'url' => ProductResource::getUrl('index', ['tenant' => $tenant]),
                'color' => 'success',
                'description' => 'Tambahkan produk baru ke toko',
            ],
            [
                'label' => 'Store Baru',
                'icon' => 'heroicon-o-building-storefront',
                'url' => route('filament.console.tenant.registration'),
                'color' => 'purple',
                'description' => 'Buat toko atau cabang baru',
            ],
        ];
    }
}
