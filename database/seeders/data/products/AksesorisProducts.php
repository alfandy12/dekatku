<?php

namespace Database\Seeders\Data\Products;

class AksesorisProducts
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Gelang Manik Handmade',
                'price' => 15000,
                'description' => 'Gelang manik-manik warna-warni buatan UMKM.',
                'url_media' => 'product/aksesoris/gelang-manik.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Kalung Kayu Etnik',
                'price' => 25000,
                'description' => 'Kalung kayu etnik cocok untuk gaya casual.',
                'url_media' => 'product/aksesoris/kalung-kayu.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Anting Acrylic Transparan',
                'price' => 18000,
                'description' => 'Anting acrylic ringan dan stylish.',
                'url_media' => 'product/aksesoris/anting.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Cincin Adjustable Simple',
                'price' => 12000,
                'description' => 'Cincin adjustable desain minimalis.',
                'url_media' => 'product/aksesoris/cincin.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Bando Kain Motif',
                'price' => 10000,
                'description' => 'Bando kain motif floral cantik.',
                'url_media' => 'product/aksesoris/bando.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Pin Bross',
                'price' => 10000,
                'description' => 'Bross bunga handmade dari kain flanel.',
                'url_media' => 'product/aksesoris/pin.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Gantungan Kunci Acrylic',
                'price' => 12000,
                'description' => 'Gantungan kunci acrylic custom desain unik.',
                'url_media' => 'product/aksesoris/gantungan-kunci.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Gelang Tali Prusik',
                'price' => 15000,
                'description' => 'Gelang tali prusik adjustable untuk harian.',
                'url_media' => 'product/aksesoris/gelang.jpg',
                'categories' => ['Aksesoris']
            ],
            [
                'title' => 'Headpiece Minimalis',
                'price' => 20000,
                'description' => 'Aksesoris kepala simple elegan.',
                'url_media' => 'product/aksesoris/headpiece.jpg',
                'categories' => ['Aksesoris']
            ],
        ];
    }
}
