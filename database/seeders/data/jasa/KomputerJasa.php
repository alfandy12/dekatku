<?php

namespace Database\Seeders\data\jasa;

class KomputerJasa
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Service Laptop',
                'price' => 150000,
                'description' => 'Perbaikan laptop lemot, mati total, ganti thermal paste.',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Install Ulang Windows',
                'price' => 100000,
                'description' => 'Install Windows lengkap dengan driver & aplikasi dasar.',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Service Printer',
                'price' => 80000,
                'description' => 'Perbaikan printer macet, tinta tidak keluar, atau error.',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Pasang WiFi Router',
                'price' => 120000,
                'description' => 'Instalasi router WiFi dan konfigurasi jaringan.',
                'categories' => ['Jasa Komputer']
            ],
            [
                'title' => 'Recovery Data',
                'price' => 250000,
                'description' => 'Pemulihan data dari hardisk/flashdisk rusak atau tidak terbaca.',
                'categories' => ['Jasa Komputer']
            ],
        ];
    }
}
