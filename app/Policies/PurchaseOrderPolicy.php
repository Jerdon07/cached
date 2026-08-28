<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;
use App\PurchaseOrderStatus;
use Illuminate\Auth\Access\Response;

class PurchaseOrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_purchase_orders');
    }

    public function view(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasPermissionTo('view_purchase_orders');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_purchase_orders');
    }

    public function update(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $purchaseOrder->created_by === $user->id
            && in_array($purchaseOrder->status, [
                PurchaseOrderStatus::Draft,
                PurchaseOrderStatus::Pending,
            ], true);
    }

    public function delete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $purchaseOrder->created_by === $user->id;
    }

    /* 
    * Can approve puchase orders with pending status
    */
    public function approve(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasPermissionTo('approve_purchase_orders')
            && $purchaseOrder->status === PurchaseOrderStatus::Pending;
    }

    /* 
    * Can reject puchase orders with pending status
    */
    public function reject(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasPermissionTo('reject_purchase_orders')
            && $purchaseOrder->status === PurchaseOrderStatus::Pending;
    }

    /* 
    * Can approve puchase orders with approved status
    */
    public function complete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasPermissionTo('complete_purchase_orders')
            && $purchaseOrder->status === PurchaseOrderStatus::Approved;
    }
}
