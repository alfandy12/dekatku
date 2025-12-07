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
                'slug' => 'makanan'
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman'
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris'
            ],
            [
                'name' => 'Tanaman',
                'slug' => 'tanaman'
            ],
            [
                'name' => 'Souvenir',
                'slug' => 'souvenir'
            ],
            [
                'name' => 'Jasa Elektronik',
                'slug' => 'jasa-elektronik'
            ],
            [
                'name' => 'Jasa Komputer',
                'slug' => 'jasa-komputer'
            ],
            [
                'name' => 'Jasa Bangunan',
                'slug' => 'jasa-bangunan'
            ],
            [
                'name' => 'Jasa Otomotif',
                'slug' => 'jasa-otomotif'
            ],
        ];



        foreach ($categories as $category) {
            Categories::create($category);
        }

        $this->command->info('Succes creating categories seeder');
    }
}
