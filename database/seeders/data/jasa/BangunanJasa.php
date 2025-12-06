<?php

namespace Database\Seeders\data\jasa;

class BangunanJasa
{
    public static function getAll(): array
    {

        return [
            [
                'title' => 'Tukang Renovasi Rumah',
                'price' => 500000,
                'description' => 'Renovasi kecil: perbaikan dinding, pengecatan, keramik.',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pengecatan Rumah',
                'price' => 300000,
                'description' => 'Pengecatan tembok dalam dan luar rumah.',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pasang Keramik',
                'price' => 200000,
                'description' => 'Pemasangan keramik lantai dan dinding.',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Tukang Listrik Rumah',
                'price' => 100000,
                'description' => 'Perbaikan instalasi listrik, stop kontak, dan MCB.',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Service Atap Bocor',
                'price' => 250000,
                'description' => 'Perbaikan atap bocor, genteng pecah, dan talang air.',
                'categories' => ['Jasa Bangunan']
            ],
        ];
    }
}
