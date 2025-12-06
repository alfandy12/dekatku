<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament; // 1. Import Facade Filament

class StoreInfo extends Widget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected static string $view = 'filament.widgets.store-info';

    // Opsional: Biar judul widgetnya sesuai nama toko
    protected function getViewData(): array
    {
        return [
            'storeData' => $this->getStoreData(),
            'storeName' => Filament::getTenant()->title,
        ];
    }

    public function getStoreData(): array
    {
        // 2. Ambil Data Toko yang sedang aktif
        $store = Filament::getTenant();

        // Ambil User Owner (Opsional, buat ambil email/hp owner)
        $owner = Auth::user();

        return [
            [
                'label' => 'Nama Toko',
                'value' => $store->title,
                'icon' => 'heroicon-o-building-storefront',
            ],
            [
                'label' => 'Deskripsi',
                'value' => $store->description ?? 'Belum ada deskripsi',
                'icon' => 'heroicon-o-information-circle',
            ],
            [
                'label' => 'Pemilik',
                'value' => $owner->name,
                'icon' => 'heroicon-o-user',
            ],
            [
                'label' => 'Email Pemilik',
                'value' => $owner->email,
                'icon' => 'heroicon-o-envelope',
            ],
            [
                'label' => 'Koordinat Lokasi',
                'value' => $this->formatLocation($store->location),
                'icon' => 'heroicon-o-map-pin',
            ],
        ];
    }

    private function formatLocation($location)
    {
        if (empty($location)) return 'Belum disetting';

        $loc = is_string($location) ? json_decode($location, true) : $location;

        if (isset($loc['lat']) && isset($loc['lng'])) {
            return $loc['lat'] . ', ' . $loc['lng'];
        }

        return 'Data lokasi tidak valid';
    }
}
