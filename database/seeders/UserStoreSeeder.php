<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Store;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserStoreSeeder extends Seeder
{
    public function run(): void
    {

        //data user
        $users = [
            [
                'name' => 'Ucup Saepudin',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saeful',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saeluh',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saebeng',
                'email' => 'test4@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saerang',
                'email' => 'test5@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saedun',
                'email' => 'test6@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saemen',
                'email' => 'test7@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saewang',
                'email' => 'test8@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saesong',
                'email' => 'test9@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Saedot',
                'email' => 'test10@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];


        //insert
        User::insert($users);

        //data store
        $stores = [
            // Makanan & Minuman
            [
                'title' => 'Warung Rasa Nusantara',
                'type' => 'product',
                'slug' => 'warung-rasa-nusantara',
                'url_media' => 'store/makanan-minuman/warung-rasa-nusantara/logo.png',
                'location' => json_encode(['lat' => -6.595000, 'lng' => 106.790000]),
                'description' => 'Warung makanan tradisional dengan cita rasa nusantara.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dapur Sehat UMKM',
                'type' => 'product',
                'slug' => 'dapur-sehat-umkm',
                'url_media' => 'store/makanan-minuman/dapur-sehat-umkm/logo.png',
                'location' => json_encode(['lat' => -6.592000, 'lng' => 106.785000]),
                'description' => 'Menyajikan makanan sehat dan berkualitas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cita Rasa Lokal',
                'type' => 'product',
                'slug' => 'cita-rasa-lokal',
                'url_media' => 'store/makanan-minuman/cita-rasa-lokal/logo.png',
                'location' => json_encode(['lat' => -6.590000, 'lng' => 106.780000]),
                'description' => 'Makanan dan minuman khas lokal, nikmat dan bergizi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Aksesoris
            [
                'title' => 'Glitz & Glam Accessories',
                'type' => 'product',
                'slug' => 'glitz-glam-accessories',
                'url_media' => 'store/aksesoris/glitz-glam-accessories/logo.png',
                'location' => json_encode(['lat' => -6.593000, 'lng' => 106.788000]),
                'description' => 'Aksesoris fashion trendi untuk semua kalangan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cantik Bersinar',
                'type' => 'product',
                'slug' => 'cantik-bersinar',
                'url_media' => 'store/aksesoris/cantik-bersinar/logo.png',
                'location' => json_encode(['lat' => -6.594500, 'lng' => 106.791000]),
                'description' => 'Perhiasan dan aksesoris cantik untuk tampilan elegan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fashionista Corner',
                'type' => 'product',
                'slug' => 'fashionista-corner',
                'url_media' => 'store/aksesoris/fashionista-corner/logo.png',
                'location' => json_encode(['lat' => -6.596000, 'lng' => 106.792500]),
                'description' => 'Aksesoris modern dan stylish untuk pria dan wanita.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tanaman
            [
                'title' => 'Hijau Asri',
                'type' => 'product',
                'slug' => 'hijau-asri',
                'url_media' => 'store/tanaman/hijau-asri/logo.png',
                'location' => json_encode(['lat' => -6.597000, 'lng' => 106.784000]),
                'description' => 'Tanaman hias dan bonsai untuk rumah dan kantor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Taman Kecilku',
                'type' => 'product',
                'slug' => 'taman-kecilku',
                'url_media' => 'store/tanaman/taman-kecilku/logo.png',
                'location' => json_encode(['lat' => -6.598500, 'lng' => 106.787500]),
                'description' => 'Tanaman hijau dan obat-obatan herbal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bonsai & Hias',
                'type' => 'product',
                'slug' => 'bonsai-dan-hias',
                'url_media' => 'store/tanaman/bonsai-dan-hias/logo.png',
                'location' => json_encode(['lat' => -6.599500, 'lng' => 106.789000]),
                'description' => 'Bonsai mini dan tanaman hias unik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Jasa Elektronik
            [
                'title' => 'Service Elektronik Pramuka',
                'type' => 'service',
                'slug' => 'service-elektronik-pramuka',
                'url_media' => 'store/jasa/service-elektronik-pramuka/logo.png',
                'location' => json_encode(['lat' => -6.600000, 'lng' => 106.783000]),
                'description' => 'Perbaikan elektronik rumah dan gadget.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Reparasi Gadget Center',
                'type' => 'service',
                'slug' => 'reparasi-gadget-center',
                'url_media' => 'store/jasa/reparasi-gadget-center/logo.png',
                'location' => json_encode(['lat' => -6.601500, 'lng' => 106.784500]),
                'description' => 'Servis handphone dan perangkat elektronik cepat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TeknoFix',
                'type' => 'service',
                'slug' => 'teknofix',
                'url_media' => 'store/jasa/teknofix/logo.png',
                'location' => json_encode(['lat' => -6.603000, 'lng' => 106.786000]),
                'description' => 'Solusi elektronik untuk rumah dan kantor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Souvenir
            [
                'title' => 'Kenangan Unik',
                'type' => 'product',
                'slug' => 'kenangan-unik',
                'url_media' => 'store/souvenir/kenangan-unik/logo.png',
                'location' => json_encode(['lat' => -6.604000, 'lng' => 106.785500]),
                'description' => 'Souvenir kreatif untuk hadiah dan acara spesial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Oleh-Oleh Istimewa',
                'type' => 'product',
                'slug' => 'oleh-oleh-istimewa',
                'url_media' => 'store/souvenir/oleh-oleh-istimewa/logo.png',
                'location' => json_encode(['lat' => -6.605500, 'lng' => 106.787000]),
                'description' => 'Souvenir dan oleh-oleh khas lokal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Charmy Souvenir',
                'type' => 'product',
                'slug' => 'charmy-souvenir',
                'url_media' => 'store/souvenir/charmy-souvenir/logo.png',
                'location' => json_encode(['lat' => -6.607000, 'lng' => 106.788500]),
                'description' => 'Souvenir lucu dan unik untuk segala acara.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $createdStores = [];
        foreach ($stores as $s) {
            $createdStores[] = Store::create($s);
        }

        $allStores = collect($createdStores);

        //get all users and attach stores
        $allUsers = User::all();
        // User 1
        $allUsers[0]->stores()->attach([
            $allStores[0]->id => ['is_owner' => true],
            $allStores[1]->id => ['is_owner' => false],
            $allStores[2]->id => ['is_owner' => false],
        ]);

        // User 2
        $allUsers[1]->stores()->attach([
            $allStores[1]->id => ['is_owner' => true],
            $allStores[3]->id => ['is_owner' => false],
            $allStores[4]->id => ['is_owner' => false],
        ]);

        // User 3
        $allUsers[2]->stores()->attach([
            $allStores[2]->id => ['is_owner' => true],
            $allStores[5]->id => ['is_owner' => false],
        ]);

        // User 4
        $allUsers[3]->stores()->attach([
            $allStores[6]->id => ['is_owner' => true],
            $allStores[7]->id => ['is_owner' => false],
        ]);

        // User 5
        $allUsers[4]->stores()->attach([
            $allStores[8]->id => ['is_owner' => true],
            $allStores[9]->id => ['is_owner' => false],
            $allStores[10]->id => ['is_owner' => false],
        ]);

        // User 6
        $allUsers[5]->stores()->attach([
            $allStores[11]->id => ['is_owner' => true],
            $allStores[12]->id => ['is_owner' => false],
        ]);

        // User 7
        $allUsers[6]->stores()->attach([
            $allStores[13]->id => ['is_owner' => true],
            $allStores[14]->id => ['is_owner' => false],
        ]);

        // User 8
        $allUsers[7]->stores()->attach([
            $allStores[0]->id => ['is_owner' => false],
            $allStores[4]->id => ['is_owner' => false],
        ]);

        // User 9
        $allUsers[8]->stores()->attach([
            $allStores[2]->id => ['is_owner' => false],
            $allStores[6]->id => ['is_owner' => false],
        ]);

        // User 10
        $allUsers[9]->stores()->attach([
            $allStores[8]->id => ['is_owner' => false],
            $allStores[12]->id => ['is_owner' => false],
        ]);

        $allPermissions = Permission::pluck('id');

        foreach ($allUsers as $user) {
            $store = $user->stores()->first();

            $newRole = Role::firstOrCreate(
                    [
                        'name' => 'super_admin_store_' . $store->id,
                        'guard_name' => 'web',
                        'store_id' => $store->id
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
            );


            $newRole->syncPermissions($allPermissions);

            $user->roles()->syncWithoutDetaching([
                $newRole->id => [
                    'store_id' => $store->id,
                    'model_type' => get_class($user)
                ]
            ]);

        }
    }
}
