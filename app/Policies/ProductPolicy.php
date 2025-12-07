<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Helper untuk mengecek permission dengan guard.
     */
    private function check(Authenticatable $user, string $permission): bool
    {
        $guard = $user->guard_name ?? config('auth.defaults.guard') ?? 'admin';
        if (method_exists($user, 'hasPermissionTo')) {
            return $user->hasPermissionTo($permission, $guard);
        }

        return $user->can($permission);
    }

    public function viewAny(Authenticatable $user): bool
    {
        return $this->check($user, 'view_any_product');
    }

    public function view(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'view_product');
    }

    public function create(Authenticatable $user): bool
    {
        return $this->check($user, 'create_product');
    }

    public function update(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'update_product');
    }

    public function delete(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'delete_product');
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'delete_any_product');
    }

    public function forceDelete(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'force_delete_product');
    }

    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'force_delete_any_product');
    }

    public function restore(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'restore_product');
    }

    public function restoreAny(Authenticatable $user): bool
    {
        return $this->check($user, 'restore_any_product');
    }

    public function replicate(Authenticatable $user, Product $product): bool
    {
        return $this->check($user, 'replicate_product');
    }

    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_product');
    }
}
