<?php

namespace Database\Seeders\data\jasa;

class ElektronicJasa
{
    public static function getAll(): array
    {
        return  [
            [
                'title' => 'Service TV LED/LCD',
                'price' => 150000,
                'description' => 'Perbaikan TV LED/LCD mati total, gambar hilang, atau layar bergaris.',
                'url_media' => 'product/jasa-elektronik/tv.jpg',
                'categories' => ['Jasa Elektronik']
            ],
            [
                'title' => 'Service Kulkas',
                'price' => 180000,
                'description' => 'Perbaikan kulkas tidak dingin, bocor freon, dan masalah kompresor.',
                'url_media' => 'product/jasa-elektronik/kulkas.jpg',
                'categories' => ['Jasa Elektronik']
            ],
            [
                'title' => 'Service Mesin Cuci',
                'price' => 160000,
                'description' => 'Mesin cuci tidak berputar, error, atau bocor.',
                'url_media' => 'product/jasa-elektronik/cuci.jpg',
                'categories' => ['Jasa Elektronik']
            ],
            [
                'title' => 'Cuci AC & Tambah Freon',
                'price' => 120000,
                'description' => 'Layanan cuci AC, tambah freon, dan perbaikan minor.',
                'url_media' => 'product/jasa-elektronik/ac.jpg',
                'categories' => ['Jasa Elektronik']
            ],
        ];
    }
}
