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
                'url_media' => 'product/jasa-bangunan/listrik.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pengecatan Rumah',
                'price' => 300000,
                'description' => 'Pengecatan tembok dalam dan luar rumah.',
                'url_media' => 'product/jasa-bangunan/cat.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Pasang Keramik',
                'price' => 200000,
                'description' => 'Pemasangan keramik lantai dan dinding.',
                'url_media' => 'product/jasa-bangunan/lantai.jpg',
                'categories' => ['Jasa Bangunan']
            ],
            [
                'title' => 'Jasa Tukang Listrik Rumah',
                'price' => 100000,
                'description' => 'Perbaikan instalasi listrik, stop kontak, dan MCB.',
                'url_media' => 'product/jasa-bangunan/listrik.jpg',
                'categories' => ['Jasa Bangunan']
            ],
        ];
    }
}
