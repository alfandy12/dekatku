<?php

namespace Database\Seeders\Data\Jasa;

class BangunanJasa
{
    public static function getAll(): array
    {

        return [
            [
                'title' => 'Tukang Renovasi Rumah',
                'price' => 500000,
                'description' => 'Renovasi kecil: perbaikan dinding, pengecatan, keramik.',
                'url_media' => 'products/jasa-bangunan/renovasi.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pengecatan Rumah',
                'price' => 300000,
                'description' => 'Pengecatan tembok dalam dan luar rumah.',
                'url_media' => 'products/jasa-bangunan/pengecatan.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pasang Keramik',
                'price' => 200000,
                'description' => 'Pemasangan keramik lantai dan dinding.',
                'url_media' => 'products/jasa-bangunan/pasang-keramik.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Tukang Listrik Rumah',
                'price' => 100000,
                'description' => 'Perbaikan instalasi listrik, stop kontak, dan MCB.',
                'url_media' => 'products/jasa-bangunan/listrik.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Service Atap Bocor',
                'price' => 250000,
                'description' => 'Perbaikan atap bocor, genteng pecah, dan talang air.',
                'url_media' => 'products/jasa-bangunan/atap-bocor.jpg',
                'categories' => ['Jasa Bangunan']
            ],
        ];
    }
}
