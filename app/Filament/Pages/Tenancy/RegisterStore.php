<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Role;
use App\Models\Store;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Trait\StoreTrait;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\MaxWidth;
use App\Trait\Store\FieldRegistration;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterStore extends RegisterTenant
{
    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public static function getLabel(): string
    {
        return 'Register Store';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                FieldRegistration::formFields()
            );
    }

    protected function handleRegistration(array $data): Store
    {
        // Pastikan Role di-import: use Spatie\Permission\Models\Role;
        // Pastikan Store di-import: use App\Models\Store;

        DB::beginTransaction();

        try {
            $store = Store::create($data);

            /** @var \App\Models\User $user */
            $user = auth()->user();

            // 1. Hubungkan User ke Store (Tenant)
            $store->users()->attach($user);

            // 2. Cari atau Buat Peran Super Admin yang Terikat pada Store BARU
            // pastikan $newSuperAdminRole adalah instance Role yang valid
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
                'model_type' => get_class($user), // Tambahkan model_type untuk amannya
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Disarankan untuk menggunakan \Filament\Notifications\Notification jika ini
            // adalah kode yang berjalan di frontend/Filament.
            throw $e;
        }

        return $store;
    }
}
