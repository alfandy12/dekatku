<?php

namespace App\Policies;

use App\Models\Store;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
{
    use HandlesAuthorization;

    /**
     * Helper cek permission berdasarkan guard admin.
     */
    private function check(Authenticatable $user, string $permission): bool
    {
        $guard = $user->guard_name ?? config('auth.defaults.guard');

        if ($guard === 'web') {
            return true;
        }

        if ($guard !== 'admin') {
            return false;
        }

        if (method_exists($user, 'hasPermissionTo')) {
            return $user->hasPermissionTo($permission, 'admin');
        }

        return $user->can($permission);
    }


    public function viewAny(Authenticatable $user): bool
    {
        return $this->check($user, 'view_any_store');
    }

    public function view(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'view_store');
    }

    public function create(Authenticatable $user): bool
    {
        return $this->check($user, 'create_store');
    }

    public function update(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'update_store');
    }

    public function delete(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'delete_store');
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'delete_any_store');
    }

    public function forceDelete(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'force_delete_store');
    }

    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'force_delete_any_store');
    }

    public function restore(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'restore_store');
    }

    public function restoreAny(Authenticatable $user): bool
    {
        return $this->check($user, 'restore_any_store');
    }

    public function replicate(Authenticatable $user, Store $store): bool
    {
        return $this->check($user, 'replicate_store');
    }

    public function reorder(Authenticatable $user): bool
    {
        return $this->check($user, 'reorder_store');
    }
}
