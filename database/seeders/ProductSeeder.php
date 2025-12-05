<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Categories;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Batik Wanita',
                'price' => 120000,
                'description' => '',
                'url_media' => 'store/toko-elektronik-pramuka/products/batik-wanita.jpg',
                'categories' => ['Fashion', 'Kecantikan']
            ],
            [
                'title' => 'Batik',
                'price' => 110000,
                'description' => '',
                'url_media' => 'hstore/toko-elektronik-pramuka/products/batik.jpg',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Celana Panjang',
                'price' => 90000,
                'description' => '',
                'url_media' => 'hstore/toko-elektronik-pramuka/products/celana.jpg',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Jaket Universal',
                'price' => 140000,
                'description' => '',
                'url_media' => 'hstore/toko-elektronik-pramuka/products/jaket.jpg',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Jaket Pria',
                'price' => 110000,
                'description' => '',
                'url_media' => 'hstore/toko-elektronik-pramuka/products/jaket2.jpg',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Kemeja',
                'price' => 110000,
                'description' => '',
                'url_media' => 'hstore/toko-elektronik-pramuka/products/kemeja.jpg',
                'categories' => ['Fashion']
            ],

        ];

        $stores = Store::all();
        $allCategories = Categories::all();

        if ($stores->isEmpty()) {
            $this->command->error('db store kosong!');
            return;
        }

        if ($allCategories->isEmpty()) {
            $this->command->error('db kategoris kosong');
            return;
        }

        foreach ($products as $productData) {
            $product = Product::create([
                'store_id' => $stores->random()->id,
                'title' => $productData['title'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'url_media' => $productData['url_media'],
            ]);

            $kolomKategories = [];
            foreach ($productData['categories'] as $categoryName) {
                $category = $allCategories->firstWhere('name', $categoryName);
                if ($category) {
                    $kolomKategories[] = $category->id;
                }
            }

            if (!empty($kolomKategories)) {
                $product->categories()->attach($kolomKategories);
            }
        }

        $this->command->info('Product seeder berhasil dibuat!');
    }
}
