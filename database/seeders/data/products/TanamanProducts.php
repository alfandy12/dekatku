<?php

namespace Database\Seeders\data\products;

class TanamanProducts
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Monstera Deliciosa',
                'price' => 85000,
                'description' => 'Tanaman hias populer dengan daun besar berlobang yang cocok untuk dekorasi ruangan.',
                'url_media' => 'product/tanaman/deliciosa.jpg',
                'categories' => ['Tanaman'],
            ],
            [
                'title' => 'Calathea Orbifolia',
                'price' => 70000,
                'description' => 'Tanaman indoor dengan daun lebar bermotif garis yang indah dan mudah dirawat.',
                'url_media' => 'product/tanaman/calathea.jpg',
                'categories' => ['Tanaman'],
            ],
            [
                'title' => 'Lidah Mertua (Sansevieria)',
                'price' => 25000,
                'description' => 'Tanaman yang tahan segala kondisi dan dipercaya mampu menyaring udara.',
                'url_media' => 'product/tanaman/sanseviera.jpg',
                'categories' => ['Tanaman'],
            ],
            [
                'title' => 'Aglonema Red Siam',
                'price' => 55000,
                'description' => 'Tanaman dengan warna daun merah menarik yang cocok sebagai penghias ruangan.',
                'url_media' => 'product/tanaman/aglonema.jpg',
                'categories' => ['Tanaman'],
            ],
            [
                'title' => 'Philodendron Birkin',
                'price' => 75000,
                'description' => 'Tanaman dengan garis putih pada daunnya yang unik dan eksklusif.',
                'url_media' => 'product/tanaman/philodendron.jpg',
                'categories' => ['Tanaman'],
            ],
        ];
    }
}
