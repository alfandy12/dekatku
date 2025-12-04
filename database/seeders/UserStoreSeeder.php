<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Ucup Saepudin',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ucup Saeful',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ucup Saeluh',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $this->command->info('UsersSeeder Berhasil di buat');

        $stores = [
            [
                'title' => 'Toko Elektronik Jakarta',
                'type' => 'product',
                'slug' => 'toko-elektronik-jakarta',
                'url_media' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661',
                'location' => 'Jakarta Pusat, DKI Jakarta',
                'description' => 'Toko elektronik terlengkap di Jakarta dengan berbagai pilihan gadget, komputer, dan aksesoris elektronik berkualitas tinggi.',
            ],
            [
                'title' => 'Minimarket Sejahtera',
                'type' => 'product',
                'slug' => 'minimarket-sejahtera',
                'url_media' => 'https://images.unsplash.com/photo-1604719312566-8912e9227c6a',
                'location' => 'Bandung, Jawa Barat',
                'description' => 'Minimarket dengan harga terjangkau, menyediakan kebutuhan sehari-hari lengkap untuk seluruh keluarga.',
            ],
            [
                'title' => 'Fashion Store Premium',
                'type' => 'product',
                'slug' => 'fashion-store-premium',
                'url_media' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8',
                'location' => 'Surabaya, Jawa Timur',
                'description' => 'Koleksi fashion terkini dan berkualitas dari brand lokal dan internasional. Temukan gaya Anda di sini!',
            ],
            [
                'title' => 'Toko Buku Literasi',
                'type' => 'product',
                'slug' => 'toko-buku-literasi',
                'url_media' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d',
                'location' => 'Yogyakarta, DI Yogyakarta',
                'description' => 'Surga bagi pecinta buku dengan koleksi buku dari berbagai genre, mulai dari fiksi, non-fiksi, hingga buku anak-anak.',
            ],
            [
                'title' => 'Warung Kopi Nusantara',
                'type' => 'product',
                'slug' => 'warung-kopi-nusantara',
                'url_media' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348',
                'location' => 'Semarang, Jawa Tengah',
                'description' => 'Nikmati kopi pilihan dari berbagai daerah di Indonesia dengan suasana yang nyaman dan cozy untuk bekerja atau bersantai.',
            ],
        ];

        foreach ($stores as $storeData) {
            Store::create($storeData);
        }

        $this->command->info('StoreSeeder berhasil di buat!');
        $allUsers = User::all();
        $allStores = Store::all();

        $allUsers[0]->stores()->attach([
            $allStores[0]->id,
            $allStores[1]->id,
        ]);

        $allUsers[1]->stores()->attach([
            $allStores[1]->id,
            $allStores[2]->id,
            $allStores[3]->id,
        ]);

        $allUsers[2]->stores()->attach([
            $allStores[3]->id,
            $allStores[4]->id,
        ]);

        $this->command->info('Store User seeder berhasil di buat!');
    }
}
