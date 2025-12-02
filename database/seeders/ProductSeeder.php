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
            // Makanan
            [
                'title' => 'Keripik Singkong Pedas',
                'price' => 15000,
                'description' => '<p>Keripik singkong renyah dengan bumbu pedas khas. Terbuat dari singkong pilihan berkualitas. Cocok untuk camilan dan oleh-oleh.</p>',
                'categories' => ['Makanan', 'Oleh-oleh']
            ],
            [
                'title' => 'Kue Kering Nastar Premium',
                'price' => 75000,
                'description' => '<p>Kue nastar isi nanas dengan mentega berkualitas. Kemasan 500 gram. Rasa manis legit dan tekstur lembut. Cocok untuk lebaran dan acara spesial.</p>',
                'categories' => ['Makanan', 'Oleh-oleh']
            ],
            [
                'title' => 'Sambal Pecel Madiun',
                'price' => 25000,
                'description' => '<p>Sambal pecel khas Madiun dengan resep turun-temurun. Pedas gurih dan wangi rempah. Kemasan botol 250ml.</p>',
                'categories' => ['Makanan']
            ],
            [
                'title' => 'Brownies Kukus Coklat',
                'price' => 45000,
                'description' => '<p>Brownies kukus lembut dengan coklat premium. Ukuran 20x20cm. Tanpa pengawet. Pre-order H-1.</p>',
                'categories' => ['Makanan']
            ],

            // Minuman
            [
                'title' => 'Kopi Arabica Gayo 250gr',
                'price' => 85000,
                'description' => '<p>Kopi arabica asli Gayo, Aceh. Medium roast dengan aroma floral dan rasa fruity. Kemasan standing pouch 250 gram.</p>',
                'categories' => ['Minuman', 'Oleh-oleh']
            ],
            [
                'title' => 'Jamu Kunyit Asam Instan',
                'price' => 30000,
                'description' => '<p>Jamu kunyit asam praktis dalam kemasan sachet. Isi 10 sachet. Tanpa pewarna dan pengawet buatan.</p>',
                'categories' => ['Minuman', 'Kecantikan']
            ],

            // Fashion
            [
                'title' => 'Hijab Segi Empat Voal',
                'price' => 35000,
                'description' => '<p>Hijab voal premium ukuran 110x110cm. Bahan adem dan tidak menerawang. Tersedia 15 pilihan warna cantik.</p>',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Kemeja Batik Pria Slim Fit',
                'price' => 125000,
                'description' => '<p>Kemeja batik cap tulis kombinasi. Bahan katun halus. Cocok untuk acara formal dan kasual.</p>',
                'categories' => ['Fashion']
            ],
            [
                'title' => 'Gamis Wanita Syari',
                'price' => 185000,
                'description' => '<p>Gamis syari bahan wolfis premium. Set dengan bergo. Busui friendly. Tersedia size S-XXL.</p>',
                'categories' => ['Fashion']
            ],

            // Kerajinan Tangan
            [
                'title' => 'Tas Anyaman Rotan',
                'price' => 150000,
                'description' => '<p>Tas anyaman rotan asli handmade. Ukuran medium dengan furing kain. Cocok untuk hangout dan daily use.</p>',
                'categories' => ['Kerajinan Tangan', 'Aksesoris']
            ],
            [
                'title' => 'Bros Flanel Karakter',
                'price' => 12000,
                'description' => '<p>Bros dari kain flanel dengan berbagai karakter lucu. Handmade dengan detail rapi. Cocok untuk souvenir.</p>',
                'categories' => ['Kerajinan Tangan', 'Aksesoris']
            ],
            [
                'title' => 'Gantungan Kunci Makrame',
                'price' => 18000,
                'description' => '<p>Gantungan kunci makrame handmade dengan benang premium. Desain unik dan aesthetic. Custom nama tersedia.</p>',
                'categories' => ['Kerajinan Tangan', 'Aksesoris']
            ],

            // Kecantikan
            [
                'title' => 'Sabun Herbal Susu Kambing',
                'price' => 25000,
                'description' => '<p>Sabun susu kambing asli untuk kulit sensitif. Melembabkan dan mencerahkan. Tanpa pewangi sintetis.</p>',
                'categories' => ['Kecantikan']
            ],
            [
                'title' => 'Lulur Bali Tradisional',
                'price' => 35000,
                'description' => '<p>Lulur tradisional Bali dengan rempah pilihan. Untuk perawatan kulit dan mencerahkan. Kemasan 250 gram.</p>',
                'categories' => ['Kecantikan']
            ],
            [
                'title' => 'Lip Tint Alami Organik',
                'price' => 45000,
                'description' => '<p>Lip tint dari bahan alami organik. Long lasting dan melembabkan. Tersedia 5 shade natural.</p>',
                'categories' => ['Kecantikan']
            ],

            // Rumah Tangga
            [
                'title' => 'Taplak Meja Batik',
                'price' => 95000,
                'description' => '<p>Taplak meja batik cap ukuran 150x150cm. Bahan katun premium. Motif modern dan elegan.</p>',
                'categories' => ['Rumah Tangga', 'Kerajinan Tangan']
            ],
            [
                'title' => 'Sapu Lidi Ijuk Premium',
                'price' => 35000,
                'description' => '<p>Sapu lidi ijuk berkualitas dengan gagang kayu. Awet dan kuat. Cocok untuk halaman dan teras.</p>',
                'categories' => ['Rumah Tangga']
            ],

            // Tanaman
            [
                'title' => 'Tanaman Hias Monstera',
                'price' => 55000,
                'description' => '<p>Tanaman monstera deliciosa ukuran sedang. Sudah di pot plastik. Mudah perawatan dan cocok indoor.</p>',
                'categories' => ['Tanaman']
            ],
            [
                'title' => 'Bibit Cabai Rawit Hibrida',
                'price' => 5000,
                'description' => '<p>Bibit cabai rawit unggul produktif. Siap tanam dalam polybag. Cocok untuk TOGA di rumah.</p>',
                'categories' => ['Tanaman']
            ],

            // Jasa
            [
                'title' => 'Jasa Catering Nasi Box',
                'price' => 25000,
                'description' => '<p>Jasa catering nasi box untuk acara. Menu lengkap dengan lauk 2 macam, sayur, dan buah. Minimal order 20 box.</p>',
                'categories' => ['Jasa', 'Makanan']
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
                'url_media' => null,
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

        $this->command->info('Kategories seeder berhasil di buat');
    }
}
