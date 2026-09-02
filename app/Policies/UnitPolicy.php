<?php

namespace App\Policies;

use App\Models\Unit;
use App\Models\User;

class UnitPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_units');
    }

    public function view(User $user, Unit $unit): bool
    {
        return $user->hasPermissionTo('view_units');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_units');
    }

    public function update(User $user, Unit $unit): bool
    {
        return $user->hasPermissionTo('update_units');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_units');
    }

    public function delete(User $user, Unit $unit): bool
    {
        return $user->hasPermissionTo('delete_units');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_units');
    }

    public function restore(User $user, Unit $unit): bool
    {
        return $user->hasPermissionTo('restore_units');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_units');
    }

    public function forceDelete(User $user, Unit $unit): bool
    {
        return $user->hasPermissionTo('force_delete_units');
    }
}
