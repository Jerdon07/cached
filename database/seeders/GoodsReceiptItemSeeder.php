<?php

namespace Database\Seeders;

use App\Models\GoodsReceiptItem;
use Illuminate\Database\Seeder;

class GoodsReceiptItemSeeder extends Seeder
{
    public function run(): void
    {
        GoodsReceiptItem::firstOrCreate([
            'goods_receipt_id' => 1,
            'purchase_order_item_id' => 1,
            'warehouse_location_id' => 1,
        ], [
            'quantity_received' => 50.00,
        ]);
    }
}
