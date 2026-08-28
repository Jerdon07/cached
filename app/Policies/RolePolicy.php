<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_all_roles');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('view_roles');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_roles');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('update_roles');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('delete_roles');
    }
}
