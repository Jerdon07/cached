<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_permissions');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('view_permissions');
    }
}
