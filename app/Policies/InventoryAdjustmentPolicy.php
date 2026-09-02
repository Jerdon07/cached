<?php

namespace App\Policies;

use App\InventoryAdjustmentStatus;
use App\Models\InventoryAdjustment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventoryAdjustmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_inventory_adjustments');
    }

    public function view(User $user, InventoryAdjustment $inventoryAdjustment): bool
    {
        return $user->hasPermissionTo('view_inventory_adjustments');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_inventory_adjustments');
    }

    public function update(User $user, InventoryAdjustment $inventoryAdjustment): bool
    {
        return $user->hasPermissionTo('update_inventory_adjustments');
    }

    public function submit(User $user): bool
    {
        return $user->hasPermissionTo('submit_inventory_adjustments');
    }
    
    public function approve(User $user, InventoryAdjustment $inventoryAdjustment): bool
    {
        return $user->hasPermissionTo('approve_inventory_adjustments')
            && $inventoryAdjustment->status === InventoryAdjustmentStatus::Pending;
    }

    public function reject(User $user, InventoryAdjustment $inventoryAdjustment): bool
    {
        return $user->hasPermissionTo('reject_inventory_adjustments')
            && $inventoryAdjustment->status === InventoryAdjustmentStatus::Pending;
    }

    public function delete(User $user, InventoryAdjustment $inventoryAdjustment): bool
    {
        return $user->hasPermissionTo('delete_inventory_adjustments')
            && in_array($inventoryAdjustment->status, [
                InventoryAdjustmentStatus::Draft,
                InventoryAdjustmentStatus::Pending,
            ]);
    }
}
