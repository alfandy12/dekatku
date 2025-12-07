<?php

namespace App\Policies;

use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class RolePolicy
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
        return $this->check($user, 'view_any_role');
    }

    public function view(Authenticatable $user, Role $role): bool
    {
        return $this->check($user, 'view_role');
    }

    public function create(Authenticatable $user): bool
    {
        return $this->check($user, 'create_role');
    }

    public function update(Authenticatable $user, Role $role): bool
    {
        return $this->check($user, 'update_role');
    }

    public function delete(Authenticatable $user, Role $role): bool
    {
        return $this->check($user, 'delete_role');
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'delete_any_role');
    }

    public function forceDelete(Authenticatable $user, Role $role): bool
    {
        return $this->check($user, 'force_delete_role');
    }

    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $this->check($user, 'force_delete_any_role');
    }

   
}
