<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_all_permissions');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('view_permissions');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_permissions');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('update_permissions');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('delete_permissions');
    }
}
