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

        DB::beginTransaction();

        try {
            $store = Store::create($data);

            $user = auth()->user();

            $store->users()->attach($user, ['is_owner' => 1]);

            $newSuperAdminRole = Role::firstOrCreate(
                [
                    'name' => 'super_admin',
                    'guard_name' => 'web',
                    'store_id' => $store->id,
                ]
            );

            $allPermissions = Permission::where('guard_name', 'web')->get();

            $newSuperAdminRole->givePermissionTo($allPermissions);

            $user->roles()->attach($newSuperAdminRole->id, [
                'store_id' => $store->id,
                'model_type' => get_class($user),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $store;
    }
}
