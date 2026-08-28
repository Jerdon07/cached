<?php

namespace App\Policies;

use App\Models\PurchaseOrderItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PurchaseOrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_purchase_order_items');
    }

    public function view(User $user, PurchaseOrderItem $purchaseOrderItem): bool
    {
        return $user->hasPermissionTo('view_purchase_order_items');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_purchase_order_items');
    }

    public function update(User $user, PurchaseOrderItem $purchaseOrderItem): bool
    {
        return $user->hasPermissionTo('update_purchase_order_items');
    }

    public function delete(User $user, PurchaseOrderItem $purchaseOrderItem): bool
    {
        return $user->hasPermissionTo('delete_purchase_order_items');
    }
}
