<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class StoreInfo extends Widget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected static string $view = 'filament.widgets.store-info';

    protected function getViewData(): array
    {
        return [
            'storeData' => $this->getStoreData(),
            'storeName' => Filament::getTenant()->title,
        ];
    }

    public function getStoreData(): array
    {
        $store = Filament::getTenant();

        $store->load(['contacts', 'socials']);

        $data = [
            [
                'label' => 'Nama Toko',
                'value' => $store->title,
                'icon' => 'heroicon-o-building-storefront',
            ],
            [
                'label' => 'Deskripsi',
                'value' => $store->description ? Str::limit(strip_tags($store->description), 50) : 'Belum ada deskripsi',
                'icon' => 'heroicon-o-information-circle',
            ],
            [
                'label' => 'Lokasi',
                'value' => $this->formatLocation($store->location),
                'icon' => 'heroicon-o-map-pin',
            ],
        ];

        foreach ($store->contacts as $contact) {
            $icon = match ($contact->type) {
                'whatsapp' => 'heroicon-o-chat-bubble-oval-left-ellipsis',
                'email' => 'heroicon-o-envelope',
                'phone' => 'heroicon-o-phone',
                default => 'heroicon-o-identification',
            };

            $data[] = [
                'label' => ucfirst($contact->type),
                'value' => $contact->value,
                'icon' => $icon,
            ];
        }

        foreach ($store->socials as $social) {
            $data[] = [
                'label' => ucfirst($social->platform),
                'value' => $social->url,
                'icon' => 'heroicon-o-globe-alt',
            ];
        }

        if ($store->contacts->isEmpty() && $store->socials->isEmpty()) {
            $owner = Auth::user();
            $data[] = [
                'label' => 'Pemilik (Default)',
                'value' => $owner->name,
                'icon' => 'heroicon-o-user',
            ];
        }

        return $data;
    }

    private function formatLocation($location)
    {
        if (empty($location)) return 'Belum disetting';

        $loc = is_string($location) ? json_decode($location, true) : $location;

        if (isset($loc['lat']) && isset($loc['lng'])) {
            return number_format($loc['lat'], 4) . ', ' . number_format($loc['lng'], 4);
        }

        return 'Data lokasi tidak valid';
    }
}
