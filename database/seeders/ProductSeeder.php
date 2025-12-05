<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Database\Seeders\data\jasa\KomputerJasa;
use Database\Seeders\data\jasa\ElektronicJasa;
use Database\Seeders\data\products\FashionProducts;
use Database\Seeders\data\products\TanamanProducts;
use Database\Seeders\data\products\SouvenirProducts;
use Database\Seeders\data\products\AksesorisProducts;
use Database\Seeders\data\products\MakananMinumanProducts;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allCategories = Categories::all();

        if ($allCategories->isEmpty()) {
            $this->command->error('Tabel categories kosong! Jalankan seeder kategori dulu.');
            return;
        }

        $this->insertProductsToSpecificStores(
            productsData: MakananMinumanProducts::getAll(),
            storeSlugs: [
                'warung-rasa-nusantara',
                'dapur-sehat-umkm',
                'cita-rasa-lokal'
            ],
            allCategories: $allCategories
        );

        $fashionAksesoris = array_merge(AksesorisProducts::getAll(), FashionProducts::getAll());

        $this->insertProductsToSpecificStores(
            productsData: $fashionAksesoris,
            storeSlugs: [
                'glitz-glam-accessories',
                'cantik-bersinar',
                'fashionista-corner'
            ],
            allCategories: $allCategories
        );

        $this->insertProductsToSpecificStores(
            productsData: TanamanProducts::getAll(),
            storeSlugs: [
                'hijau-asri',
                'taman-kecilku',
                'bonsai-dan-hias'
            ],
            allCategories: $allCategories
        );

        $this->insertProductsToSpecificStores(
            productsData: SouvenirProducts::getAll(),
            storeSlugs: [
                'kenangan-unik',
                'oleh-oleh-istimewa',
                'charmy-souvenir'
            ],
            allCategories: $allCategories
        );

        $jasaTeknologi = array_merge(ElektronicJasa::getAll(), KomputerJasa::getAll());

        $this->insertProductsToSpecificStores(
            productsData: $jasaTeknologi,
            storeSlugs: [
                'service-elektronik-pramuka',
                'reparasi-gadget-center',
                'teknofix'
            ],
            allCategories: $allCategories
        );


        $this->command->info('Product seeder berhasil! Produk sudah masuk ke toko yang sesuai spesifikasinya.');
    }

    private function insertProductsToSpecificStores(array $productsData, array $storeSlugs, Collection $allCategories)
    {
        $targetStores = Store::whereIn('slug', $storeSlugs)->get();

        if ($targetStores->isEmpty()) {
            $this->command->warn("Tidak ada toko ditemukan untuk slugs: " . implode(', ', $storeSlugs));
            return;
        }

        foreach ($productsData as $data) {
            $randomStore = $targetStores->random();

            $product = Product::create([
                'store_id'    => $randomStore->id,
                'title'       => $data['title'],
                'price'       => $data['price'],
                'description' => $data['description'],
                'url_media'   => $data['url_media'] ?? null,
            ]);

            $categoryIds = [];
            foreach ($data['categories'] as $categoryName) {
                $cat = $allCategories->firstWhere('name', $categoryName);
                if ($cat) {
                    $categoryIds[] = $cat->id;
                }
            }

            if (!empty($categoryIds)) {
                $product->categories()->attach($categoryIds);
            }
        }
    }
}
