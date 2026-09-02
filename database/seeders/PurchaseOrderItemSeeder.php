<?php

namespace Database\Seeders;

use App\Models\PurchaseOrderItem;
use Illuminate\Database\Seeder;

class PurchaseOrderItemSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseOrderItem::firstOrCreate([
            'purchase_order_id' => 1,
            'product_id' => 1,
        ], [
            'quantity' => 20.00,
            'unit_cost' => 50.00,
        ]);
    }
}
