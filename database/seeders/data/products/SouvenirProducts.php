<?php

namespace Database\Seeders\data\products;

class SouvenirProducts
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Souvenir Pernikahan Kotak Kecil',
                'price' => 15000,
                'description' => 'Kotak kecil cantik untuk souvenir pernikahan dengan pita dekoratif.',
                'url_media' => 'product/souvenir/souvenir-kotak.jpg',
                'categories' => ['Souvenir'],
            ],
            [
                'title' => 'Mug Custom Printing',
                'price' => 35000,
                'description' => 'Mug putih dengan cetak gambar/logo sesuai pesanan.',
                'url_media' => 'product/souvenir/mug-custom.jpg',
                'categories' => ['Souvenir'],
            ],
            [
                'title' => 'Tas Kanvas Mini',
                'price' => 25000,
                'description' => 'Tas kanvas kecil cocok untuk souvenir seminar atau event kecil.',
                'url_media' => 'product/souvenir/tas-kanvas.jpg',
                'categories' => ['Souvenir'],
            ],
            [
                'title' => 'Notebook Mini',
                'price' => 15000,
                'description' => 'Notebook mini dengan cover custom, cocok untuk seminar atau event.',
                'url_media' => 'product/souvenir/notebook.jpg',
                'categories' => ['Souvenir'],
            ],
            [
                'title' => 'Tempat Pensil Kayu',
                'price' => 20000,
                'description' => 'Tempat pensil dari kayu dengan ukiran nama atau logo custom.',
                'url_media' => 'product/souvenir/tempat-pensil.jpg',
                'categories' => ['Souvenir'],
            ],
            [
                'title' => 'Mini Plant Pot',
                'price' => 25000,
                'description' => 'Pot tanaman mini untuk souvenir, bisa custom tulisan atau logo.',
                'url_media' => 'product/souvenir/mini-pot.jpg',
                'categories' => ['Souvenir'],
            ],
        ];
    }
}
