<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_products');
    }

    public function view(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('view_products');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_products');
    }

    public function update(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('update_products');
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('delete_products');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_products');
    }

    public function restore(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('restore_products');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_products');
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('force_delete_products');
    }

    public function foreceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_products');
    }
}
