<?php

namespace App\Policies;

use App\Models\SalesOrderItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SalesOrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_sales_order_items');
    }

    public function view(User $user, SalesOrderItem $salesOrderItem): bool
    {
        return $user->hasPermissionTo('view_sales_order_items');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_sales_order_items');
    }

    public function update(User $user, SalesOrderItem $salesOrderItem): bool
    {
        return $user->hasPermissionTo('update_sales_order_items');
    }

    public function delete(User $user, SalesOrderItem $salesOrderItem): bool
    {
        return $user->hasPermissionTo('delete_sales_order_items');
    }
}
