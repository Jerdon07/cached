<?php

namespace App\Policies;

use App\Models\StockTransfer;
use App\Models\User;
use App\StockTransferStatus;

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
        return $user->hasPermissionTo('update_stock_transfers')
            && in_array($stockTransfer->status, [
                StockTransferStatus::Draft,
                StockTransferStatus::Pending,
            ]) && $user->id === $stockTransfer->requested_by;
    }

    public function approve(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('approve_stock_transfers')
            && $stockTransfer->status === StockTransferStatus::Pending
            && $user->id !== $stockTransfer->requested_by;
    }

    public function reject(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('reject_stock_transfers')
            && $stockTransfer->status === StockTransferStatus::Pending
            && $user->id !== $stockTransfer->requested_by;
    }

    public function dispatch(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('create_stock_transfers')
            && $stockTransfer->status === StockTransferStatus::Approved
            && $user->id === $stockTransfer->requested_by;
    }

    public function cancel(User $user, StockTransfer $stockTransfer): bool
    {
        return $user->hasPermissionTo('create_stock_transfers')
            && $stockTransfer->status === StockTransferStatus::InTransit
            && $user->id === $stockTransfer->requested_by;
    }
}
