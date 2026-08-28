<?php

namespace App\Policies;

use App\Models\GoodsReceipt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GoodsReceiptPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_goods_receipts');
    }

    public function view(User $user, GoodsReceipt $goodsReceipt): bool
    {
        return $user->hasPermissionTo('view_goods_receipts');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_goods_receipts');
    }

    public function update(User $user, GoodsReceipt $goodsReceipt): bool
    {
        return $user->hasPermissionTo('update_goods_receipts');
    }

    public function delete(User $user, GoodsReceipt $goodsReceipt): bool
    {
        return $user->hasPermissionTo('delete_goods_receipts');
    }
}
