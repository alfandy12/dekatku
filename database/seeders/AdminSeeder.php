<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // Tambahkan jika Anda akan membuat Izin
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'admin'],
            ['store_id' => null]
        );

        $admin1 = Admin::firstOrCreate(
            ['email' => 'admin@dekatku.id'],
            [
                'name' => 'Admin First',
                'password' => Hash::make('12345678'),
            ]
        );

        $admin2 = Admin::firstOrCreate(
            ['email' => 'admin2@dekatku.id'],
            [
                'name' => 'Admin second',
                'password' => Hash::make('12345678'),
            ]
        );

        $admin1->assignRole($superAdminRole);

        $permissionsJson = '["view_product","view_any_product","create_product","update_product","restore_product","restore_any_product","replicate_product","reorder_product","delete_product","delete_any_product","force_delete_product","force_delete_any_product","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_store","view_any_store","create_store","update_store","restore_store","restore_any_store","replicate_store","reorder_store","delete_store","delete_any_store","force_delete_store","force_delete_any_store"]';

        $permissions = json_decode($permissionsJson, true);

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(
                ['name' => $permissionName, 'guard_name' => 'admin']
            );
        }

        $superAdminRole->givePermissionTo(
            Permission::where('guard_name', 'admin')->get()
        );
    }
}
