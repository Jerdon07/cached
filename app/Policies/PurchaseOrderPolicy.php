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

    // Purchasing Manager approve
    public function approve(User $user): bool
    {
        return $user->hasPermissionTo('approve_purchase_orders');
    }

    // Purchasing Manager reject
    public function reject(User $user): bool
    {
        return $user->hasPermissionTo('reject_purchase_orders');
    }

    // Purchasing Officer to complete
    public function complete(User $user): bool
    {
        return $user->hasPermissionTo('complete_purchase_orders');
    }
}
