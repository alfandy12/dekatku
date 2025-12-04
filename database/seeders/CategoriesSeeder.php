<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan',
            ],
            [
                'name' => 'Minuman',
            ],
            [
                'name' => 'Fashion',
            ],
            [
                'name' => 'Kerajinan Tangan',
            ],
            [
                'name' => 'Aksesoris',
            ],
            [
                'name' => 'Kecantikan',
            ],
            [
                'name' => 'Rumah Tangga',
            ],
            [
                'name' => 'Tanaman',
            ],
            [
                'name' => 'Jasa',
            ],
            [
                'name' => 'Oleh-oleh',
            ],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }

        $this->command->info('Succes creating categories seeder');
    }
}
