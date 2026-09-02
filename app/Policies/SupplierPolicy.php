<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;

class SupplierPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_suppliers');
    }

    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasPermissionTo('view_suppliers');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_suppliers');
    }

    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasPermissionTo('update_suppliers');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_suppliers');
    }

    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasPermissionTo('delete_suppliers');
    }
}
