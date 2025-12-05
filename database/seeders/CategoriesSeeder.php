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
                'name' => 'Makanan'
            ],
            [
                'name' => 'Minuman'
            ],
            [
                'name' => 'Aksesoris'
            ],
            [
                'name' => 'Tanaman'
            ],
            [
                'name' => 'Souvenir'
            ],
            [
                'name' => 'Jasa Elektronik'
            ],
            [
                'name' => 'Jasa Komputer'
            ],
            [
                'name' => 'Jasa Bangunan'
            ],
            [
                'name' => 'Jasa Otomotif'
            ],
        ];


        foreach ($categories as $category) {
            Categories::create($category);
        }

        $this->command->info('Succes creating categories seeder');
    }
}
