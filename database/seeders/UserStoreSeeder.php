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

            [
                'name' => 'Ucup Komputer Satu',
                'email' => 'owner.komputer1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Komputer Dua',
                'email' => 'owner.komputer2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Otomotif Satu',
                'email' => 'owner.otomotif1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Otomotif Dua',
                'email' => 'owner.otomotif2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Bangunan Satu',
                'email' => 'owner.bangunan1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ucup Bangunan Dua',
                'email' => 'owner.bangunan2@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];


        User::insert($users);

        //data store
        $stores = [
            //makanan-minuman
            [
                'title' => 'Warung Rasa Nusantara',
                'type' => 'product',
                'slug' => 'warung-rasa-nusantara',
                'url_media' => 'store/warung-rasa-nusantara/logo.jpg',
                'location' => json_encode(['lat' => -6.595000, 'lng' => 106.790000]),
                'description' => 'Warung makanan tradisional.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Dapur Sehat UMKM',
                'type' => 'product',
                'slug' => 'dapur-sehat-umkm',
                'url_media' => 'store/dapur-sehat/logo.jpg',
                'location' => json_encode(['lat' => -6.592000, 'lng' => 106.785000]),
                'description' => 'Makanan sehat.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cita Rasa Lokal',
                'type' => 'product',
                'slug' => 'cita-rasa-lokal',
                'url_media' => 'store/cita-rasa-lokal/logo.jpg',
                'location' => json_encode(['lat' => -6.590000, 'lng' => 106.780000]),
                'description' => 'Makanan khas lokal.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //aksesoris
            [
                'title' => 'Glitz & Glam Accessories',
                'type' => 'product',
                'slug' => 'glitz-glam-accessories',
                'url_media' => 'store/glitz-glam-accessories/logo.jpg',
                'location' => json_encode(['lat' => -6.593000, 'lng' => 106.788000]),
                'description' => 'Aksesoris trendi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cantik Bersinar',
                'type' => 'product',
                'slug' => 'cantik-bersinar',
                'url_media' => 'store/cantik-bersinar/logo.jpg',
                'location' => json_encode(['lat' => -6.594500, 'lng' => 106.791000]),
                'description' => 'Perhiasan cantik.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Fashionista Corner',
                'type' => 'product',
                'slug' => 'fashionista-corner',
                'url_media' => 'store/fashionista-corner/logo.jpg',
                'location' => json_encode(['lat' => -6.596000, 'lng' => 106.792500]),
                'description' => 'Aksesoris modern.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //tanaman
            [
                'title' => 'Hijau Asri',
                'type' => 'product',
                'slug' => 'hijau-asri',
                'url_media' => 'store/hijau-asri/logo.jpg',
                'location' => json_encode(['lat' => -6.597000, 'lng' => 106.784000]),
                'description' => 'Tanaman hias.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Taman Kecilku',
                'type' => 'product',
                'slug' => 'taman-kecilku',
                'url_media' => 'store/taman-kecilku/logo.jpg',
                'location' => json_encode(['lat' => -6.598500, 'lng' => 106.787500]),
                'description' => 'Tanaman hijau.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Bonsai & Hias',
                'type' => 'product',
                'slug' => 'bonsai-dan-hias',
                'url_media' => 'store/bonsai-dan-hias/logo.jpg',
                'location' => json_encode(['lat' => -6.599500, 'lng' => 106.789000]),
                'description' => 'Bonsai mini.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa elektro
            [
                'title' => 'Service Elektronik Pramuka',
                'type' => 'service',
                'slug' => 'service-elektronik-pramuka',
                'url_media' => 'store/service-elektronik-pramuka/logo.jpg',
                'location' => json_encode(['lat' => -6.600000, 'lng' => 106.783000]),
                'description' => 'Perbaikan elektronik.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa tech
            [
                'title' => 'Reparasi Gadget Center',
                'type' => 'service',
                'slug' => 'reparasi-gadget-center',
                'url_media' => 'store/reparasi-gadget-center/logo.jpg',
                'location' => json_encode(['lat' => -6.601500, 'lng' => 106.784500]),
                'description' => 'Servis HP.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa elektro
            [
                'title' => 'TeknoFix',
                'type' => 'service',
                'slug' => 'teknofix',
                'url_media' => 'store/teknofix/logo.jpg',
                'location' => json_encode(['lat' => -6.603000, 'lng' => 106.786000]),
                'description' => 'Solusi elektronik.',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Souvenir
            [
                'title' => 'Kenangan Unik',
                'type' => 'product',
                'slug' => 'kenangan-unik',
                'url_media' => 'store/kenangan-unik/logo.jpg',
                'location' => json_encode(['lat' => -6.604000, 'lng' => 106.785500]),
                'description' => 'Souvenir kreatif.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Oleh-Oleh Istimewa',
                'type' => 'product',
                'slug' => 'oleh-oleh-istimewa',
                'url_media' => 'store/oleh-oleh-istimewa/logo.jpg',
                'location' => json_encode(['lat' => -6.605500, 'lng' => 106.787000]),
                'description' => 'Oleh-oleh khas.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Charmy Souvenir',
                'type' => 'product',
                'slug' => 'charmy-souvenir',
                'url_media' => 'store/charmy-souvenir/logo.jpg',
                'location' => json_encode(['lat' => -6.607000, 'lng' => 106.788500]),
                'description' => 'Souvenir lucu.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa tech
            [
                'title' => 'Dokter Laptop & PC',
                'type' => 'service',
                'slug' => 'dokter-laptop-pc',
                'url_media' => 'store/dokter-laptop/logo.jpg',
                'location' => json_encode(['lat' => -6.608000, 'lng' => 106.790000]),
                'description' => 'Service laptop dan rakit PC.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Pusat Komputer Murah',
                'type' => 'service',
                'slug' => 'pusat-komputer-murah',
                'url_media' => 'store/pusat-komputer/logo.jpg',
                'location' => json_encode(['lat' => -6.609000, 'lng' => 106.791000]),
                'description' => 'Jual beli dan servis komputer.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa otomotif
            [
                'title' => 'Bengkel Motor Berkah',
                'type' => 'service',
                'slug' => 'bengkel-motor-berkah',
                'url_media' => 'store/bengkel-motor/logo.jpg',
                'location' => json_encode(['lat' => -6.610000, 'lng' => 106.792000]),
                'description' => 'Servis motor terpercaya.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Auto Car Service',
                'type' => 'service',
                'slug' => 'auto-car-service',
                'url_media' => 'store/auto-car/logo.jpg',
                'location' => json_encode(['lat' => -6.611000, 'lng' => 106.793000]),
                'description' => 'Bengkel mobil profesional.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //jasa bangunan
            [
                'title' => 'TB. Bangunan Jaya',
                'type' => 'service',
                'slug' => 'tb-bangunan-jaya',
                'url_media' => 'store/tb-bangunan/logo.jpg',
                'location' => json_encode(['lat' => -6.612000, 'lng' => 106.794000]),
                'description' => 'Bahan bangunan dan jasa tukang.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Solusi Renovasi Rumah',
                'type' => 'service',
                'slug' => 'solusi-renovasi-rumah',
                'url_media' => 'store/solusi-renovasi/logo.jpg',
                'location' => json_encode(['lat' => -6.613000, 'lng' => 106.795000]),
                'description' => 'Kontraktor renovasi rumah.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $createdStores = [];
        foreach ($stores as $s) {
            $createdStores[] = Store::create($s);
        }

        $allStores = collect($createdStores);
        $allUsers = User::all();

        $allUsers[0]->stores()->attach([
            $allStores[0]->id => ['is_owner' => true],
        ]);

        $allUsers[1]->stores()->attach([
            $allStores[1]->id => ['is_owner' => true],
            $allStores[3]->id => ['is_owner' => false],
        ]);

        $allUsers[2]->stores()->attach([
            $allStores[2]->id => ['is_owner' => true],
            $allStores[4]->id => ['is_owner' => false],
        ]);

        $allUsers[3]->stores()->attach([
            $allStores[5]->id => ['is_owner' => true],
            $allStores[6]->id => ['is_owner' => false],
        ]);

        $allUsers[4]->stores()->attach([
            $allStores[7]->id => ['is_owner' => true],
            $allStores[8]->id => ['is_owner' => false],
        ]);

        $allUsers[5]->stores()->attach([
            $allStores[9]->id => ['is_owner' => true],
            $allStores[10]->id => ['is_owner' => false],
        ]);

        $allUsers[6]->stores()->attach([
            $allStores[11]->id => ['is_owner' => true],
            $allStores[12]->id => ['is_owner' => false],
        ]);

        $allUsers[7]->stores()->attach([
            $allStores[13]->id => ['is_owner' => true],
            $allStores[14]->id => ['is_owner' => false],
        ]);

        $allUsers[8]->stores()->attach([
            $allStores[6]->id => ['is_owner' => false],
        ]);

        $allUsers[9]->stores()->attach([
            $allStores[12]->id => ['is_owner' => true],
        ]);


        $allUsers[10]->stores()->attach([
            $allStores[15]->id => ['is_owner' => true],
        ]);

        $allUsers[11]->stores()->attach([
            $allStores[16]->id => ['is_owner' => true],
        ]);

        $allUsers[12]->stores()->attach([
            $allStores[17]->id => ['is_owner' => true],
        ]);

        $allUsers[13]->stores()->attach([
            $allStores[18]->id => ['is_owner' => true],
        ]);

        $allUsers[14]->stores()->attach([
            $allStores[19]->id => ['is_owner' => true],
        ]);

        $allUsers[15]->stores()->attach([
            $allStores[20]->id => ['is_owner' => true],
        ]);

        $allPermissions = Permission::all();

        $usersWithStoreOwnerRole = User::whereHas('stores', function ($query) {
            $query->where('is_owner', true);
        })->with(['stores' => function ($query) {
            $query->wherePivot('is_owner', true);
        }])->get();

        $this->command->info("Ditemukan " . $usersWithStoreOwnerRole->count() . " pemilik toko untuk diproses.");


        foreach ($usersWithStoreOwnerRole as $user) {

            $stores = $user->stores;

            if ($stores->isEmpty()) {
                $this->command->line("Melewatkan User {$user->email}: Tidak ada toko di mana mereka ditandai sebagai pemilik.");
                continue;
            }

            foreach ($stores as $store) {
                $storeId = $store->id;

                setPermissionsTeamId($storeId);

                $superAdminRole = Role::firstOrCreate(
                    [
                        'name' => 'super_admin',
                        'guard_name' => 'web',
                        'store_id' => $storeId,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                $superAdminRole->syncPermissions($allPermissions);

                $this->command->info("Peran 'super_admin' dibuat/diperbarui untuk ID Toko: {$storeId}.");

                $user->assignRole($superAdminRole);

                $this->command->line("User {$user->email} diberi peran 'super_admin' untuk ID Toko: {$storeId}.");
            }
        }

        setPermissionsTeamId(null);
        $this->command->info("Super Admin Seeder selesai.");
    }
}
