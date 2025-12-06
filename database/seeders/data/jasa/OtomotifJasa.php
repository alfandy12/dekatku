<?php

namespace Database\Seeders\data\jasa;

class OtomotifJasa
{
    public static function getAll(): array
    {
        return [
            [
                'title' => 'Service Motor Ringan',
                'price' => 70000,
                'description' => 'Ganti oli, setel rantai, servis karburator/injeksi.',
                'url_media' => 'product/jasa-otomotif/motor.jpg',
                'categories' => ['Jasa Otomotif']
            ],
            [
                'title' => 'Tune Up Mobil',
                'price' => 350000,
                'description' => 'Pengecekan mesin, filter, busi, dan pembersihan throttle body.',
                'url_media' => 'product/jasa-otomotif/car.jpg',
                'categories' => ['Jasa Otomotif']
            ],
            [
                'title' => 'Ganti Ban & Balancing',
                'price' => 50000,
                'description' => 'Layanan ganti ban mobil + balancing roda.',
                'url_media' => 'product/jasa-otomotif/ban.jpg',
                'categories' => ['Jasa Otomotif']
            ],
            [
                'title' => 'Service Aki & Kelistrikan',
                'price' => 80000,
                'description' => 'Cek aki lemah, alternator, dan sistem pengisian listrik.',
                'url_media' => 'product/jasa-otomotif/aki.jpg',
                'categories' => ['Jasa Otomotif']
            ],
        ];
    }
}
