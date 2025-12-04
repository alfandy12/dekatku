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
            ['name' => 'Ucup Saepudin', 'email' => 'test1@example.com', 'password' => Hash::make('password'), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ucup Saeful',   'email' => 'test2@example.com', 'password' => Hash::make('password'), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ucup Saeluh',   'email' => 'test3@example.com', 'password' => Hash::make('password'), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ];

        //insert
        User::insert($users);

        //data store
        $stores = [
            ['title' => 'Toko Elektronik Pramuka',      'type' => 'product', 'slug' => 'toko-elektronik-pramuka',      'url_media' => 'store/toko-elektronik-pramuka/logo.png',      'location' => json_encode(['lat' => -6.207114, 'lng' => 106.875379]), 'description' => 'Toko elektronik lengkap dekat daerah Pramuka.',      'created_at' => now(), 'updated_at' => now(),],
            ['title' => 'Minimarket Sejahtera Matraman', 'type' => 'product', 'slug' => 'minimarket-sejahtera-matraman', 'url_media' => 'store/minimarket-sejahtera-matraman/logo.png', 'location' => json_encode(['lat' => -6.206800, 'lng' => 106.874900]), 'description' => 'Minimarket murah dan lengkap di Matraman.',      'created_at' => now(), 'updated_at' => now(),],
            ['title' => 'Fashion Store Rawamangun',     'type' => 'product', 'slug' => 'fashion-store-rawamangun',     'url_media' => 'store/fashion-store-rawamangun/logo.png',     'location' => json_encode(['lat' => -6.208000, 'lng' => 106.876100]), 'description' => 'Fashion terkini untuk area Rawamangun.',  'created_at' => now(), 'updated_at' => now(),],
            ['title' => 'Toko Buku Salemba',            'type' => 'product', 'slug' => 'toko-buku-salemba',            'url_media' => 'store/toko-buku-salemba/logo.png',            'location' => json_encode(['lat' => -6.207500, 'lng' => 106.877000]), 'description' => 'Toko buku lengkap dekat Salemba.',      'created_at' => now(), 'updated_at' => now(),],
            ['title' => 'Warung Kopi Matraman',         'type' => 'product', 'slug' => 'warung-kopi-matraman',         'url_media' => 'store/warung-kopi-matraman/logo.png',         'location' => json_encode(['lat' => -6.206900, 'lng' => 106.875900]), 'description' => 'Tempat ngopi cozy dekat Matraman.',     'created_at' => now(), 'updated_at' => now(),],
        ];

        $createdStores = [];
        foreach ($stores as $s) {
            $createdStores[] = Store::create($s);
        }

        $allStores = collect($createdStores);

        //get all users and attach stores
        $allUsers = User::all();
        $allUsers[0]->stores()->attach([$allStores[0]->id, $allStores[1]->id]);
        $allUsers[1]->stores()->attach([$allStores[1]->id, $allStores[2]->id, $allStores[3]->id]);
        $allUsers[2]->stores()->attach([$allStores[3]->id, $allStores[4]->id]);

        $allPermissions = Permission::all();

        //assign roles
        foreach ($createdStores as $store) {
            $user = $store->users()->first();
            $newSuperAdminRole = Role::firstOrCreate(
                [
                    'name' => 'super_admin',
                    'guard_name' => 'web',
                    'store_id' => $store->id,
                ]
            );

            $allPermissions = Permission::all();

            // Tetapkan semua izin yang ada ke peran Super Admin yang baru dibuat
            $newSuperAdminRole->givePermissionTo($allPermissions);

            $user->roles()->attach($newSuperAdminRole->id, [
                'store_id' => $store->id,
                'model_type' => get_class($user),
            ]);
        }
    }
}
