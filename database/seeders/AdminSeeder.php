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
        // --- 1. Buat atau Dapatkan Role 'super_admin' (GUARD: admin, TEAM_ID: NULL/GLOBAL) ---

        // Pastikan peran 'super_admin' dibuat dengan guard 'admin'
        // dan team_id (store_id) diset NULL, menjadikannya peran GLOBAL/Non-Tenant.
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'admin'],
            ['store_id' => null] // Explicitly set team_id to NULL
        );

        // --- 2. Buat atau Dapatkan Admin ---

        $admin1 = Admin::firstOrCreate(
            ['email' => 'admin@dekatku.id'],
            [
                'name' => 'Admin First',
                'password' => Hash::make('12345678'),
            ]
        );

        // Admin Second
        $admin2 = Admin::firstOrCreate(
            ['email' => 'admin2@dekatku.id'],
            [
                'name' => 'Admin second',
                'password' => Hash::make('12345678'),
            ]
        );

        // --- 3. Tugaskan Role ke Admin Pertama ---

        // Tugaskan Role 'super_admin' kepada Admin Pertama
        $admin1->assignRole($superAdminRole);

        echo "Role 'super_admin' global berhasil ditugaskan kepada Admin First.\n";

        // --- 4. Buat Izin dan Tugaskan ke Role (Opsional, untuk kelengkapan) ---

        $permissionsJson = '["view_product","view_any_product","create_product","update_product","restore_product","restore_any_product","replicate_product","reorder_product","delete_product","delete_any_product","force_delete_product","force_delete_any_product","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role"]';

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
