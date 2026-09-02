<?php

namespace App\Policies;

use App\Models\InventoryAdjustmentItem;
use App\Models\User;

class InventoryAdjustmentItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_inventory_adjustment_items');
    }

    public function view(User $user, InventoryAdjustmentItem $inventoryAdjustmentItem): bool
    {
        return $user->hasPermissionTo('view_inventory_adjustment_items');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_inventory_adjustment_items');
    }

    public function update(User $user, InventoryAdjustmentItem $inventoryAdjustmentItem): bool
    {
        return $user->hasPermissionTo('update_inventory_adjustment_items');
    }

    public function delete(User $user, InventoryAdjustmentItem $inventoryAdjustmentItem): bool
    {
        return $user->hasPermissionTo('delete_inventory_adjustment_items');
    }
}
