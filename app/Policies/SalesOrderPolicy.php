<?php

namespace App\Policies;

use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SalesOrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_sales_orders');
    }

    public function view(User $user, SalesOrder $salesOrder): bool
    {
        return $user->hasPermissionTo('view_sales_orders');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_sales_orders');
    }

    public function update(User $user, SalesOrder $salesOrder): bool
    {
        return $user->hasPermissionTo('update_sales_orders');
    }

    public function delete(User $user, SalesOrder $salesOrder): bool
    {
        return $user->hasPermissionTo('delete_sales_orders');
    }
}
