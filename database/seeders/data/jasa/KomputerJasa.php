<?php

namespace Database\Seeders\Data\Jasa;

class KomputerJasa
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Service Laptop',
                'price' => 150000,
                'description' => 'Perbaikan laptop lemot, mati total, ganti thermal paste.',
                'url_media' => 'products/jasa-it/service-laptop.jpg',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Install Ulang Windows',
                'price' => 100000,
                'description' => 'Install Windows lengkap dengan driver & aplikasi dasar.',
                'url_media' => 'products/jasa-it/install-windows.jpg',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Service Printer',
                'price' => 80000,
                'description' => 'Perbaikan printer macet, tinta tidak keluar, atau error.',
                'url_media' => 'products/jasa-it/service-printer.jpg',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Pasang WiFi Router',
                'price' => 120000,
                'description' => 'Instalasi router WiFi dan konfigurasi jaringan.',
                'url_media' => 'products/jasa-it/pasang-wifi.jpg',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Recovery Data',
                'price' => 250000,
                'description' => 'Pemulihan data dari hardisk/flashdisk rusak atau tidak terbaca.',
                'url_media' => 'products/jasa-it/recovery-data.jpg',
                'categories' => ['Jasa Komputer']
            ],
        ];
    }
}
