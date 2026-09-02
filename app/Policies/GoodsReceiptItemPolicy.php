<?php

namespace App\Policies;

use App\Models\GoodsReceiptItem;
use App\Models\User;

class GoodsReceiptItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_goods_receipt_items');
    }

    public function view(User $user, GoodsReceiptItem $goodsReceiptItem): bool
    {
        return $user->hasPermissionTo('view_goods_receipt_items');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_goods_receipt_items');
    }

    public function update(User $user, GoodsReceiptItem $goodsReceiptItem): bool
    {
        return $user->hasPermissionTo('update_goods_receipt_items');
    }

    public function delete(User $user, GoodsReceiptItem $goodsReceiptItem): bool
    {
        return $user->hasPermissionTo('delete_goods_receipt_items');
    }
}
