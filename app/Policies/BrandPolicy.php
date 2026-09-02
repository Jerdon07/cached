<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;

class BrandPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_brands');
    }

    public function view(User $user, Brand $brand): bool
    {
        return $user->hasPermissionTo('view_brands');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_brands');
    }

    public function update(User $user, Brand $brand): bool
    {
        return $user->hasPermissionTo('update_brands');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_brands');
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $user->hasPermissionTo('delete_brands');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_brands');
    }

    public function restore(User $user, Brand $brand): bool
    {
        return $user->hasPermissionTo('restore_brands');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_brands');
    }

    public function forceDelete(User $user, Brand $brand): bool
    {
        return $user->hasPermissionTo('force_delete_brands');
    }
}
