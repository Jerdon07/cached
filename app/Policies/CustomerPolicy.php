<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_customers');
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->hasPermissionTo('view_customers');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_customers');
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->hasPermissionTo('update_customers');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete_any_customers');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->hasPermissionTo('delete_customers');
    }
}
