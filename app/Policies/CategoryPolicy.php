<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_categories');
    }

    public function view(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('view_categories');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_categories');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('update_categories');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_categories');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('delete_categories');
    }

    public function restoreAny(User $user): bool
    {
        return $user->hasPermissionTo('restore_any_categories');
    }

    public function restore(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('restore_categories');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_any_categories');
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('force_delete_categories');
    }
}
