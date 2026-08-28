<?php

namespace App\Policies;

use App\Models\StockTransferItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StockTransferItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_stock_transfer_items');
    }

    public function view(User $user, StockTransferItem $stockTransferItem): bool
    {
        return $user->hasPermissionTo('view_stock_transfer_items');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_stock_transfer_items');
    }

    public function update(User $user, StockTransferItem $stockTransferItem): bool
    {
        return $user->hasPermissionTo('update_stock_transfer_items');
    }

    public function delete(User $user, StockTransferItem $stockTransferItem): bool
    {
        return $user->hasPermissionTo('delete_stock_transfer_items');
    }
}
