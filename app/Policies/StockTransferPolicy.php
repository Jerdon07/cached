<?php

namespace App\Policies;

use App\Models\StockTransfer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StockTransferPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_stock_transfers');
    }

    public function view(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('view_stock_transfers');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_stock_transfers');
    }

    public function update(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('update_stock_transfers');
    }

    public function delete(User $user, StockTransfer $stockTransfer): bool
    {
        return false;
    }
}
