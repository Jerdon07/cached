<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Auth\Access\Response;

class WarehousePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_warehouses');
    }

    public function view(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo('view_warehouses');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_warehouses');
    }

    public function update(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo('update_warehouses');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_warehouses');
    }

    public function delete(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo('delete_warehouses');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_warehouses');
    }

    public function restore(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo('restore_warehouses');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_warehouses');
    }

    public function forceDelete(User $user, Warehouse $warehouse): bool
    {
        return $user->hasPermissionTo('force_delete_warehouses');
    }
}
