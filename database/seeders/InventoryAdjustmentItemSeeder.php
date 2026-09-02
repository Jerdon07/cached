<?php

namespace Database\Seeders;

use App\Models\InventoryAdjustmentItem;
use Illuminate\Database\Seeder;

class InventoryAdjustmentItemSeeder extends Seeder
{
    public function run(): void
    {
        InventoryAdjustmentItem::create([
            'inventory_adjustment_id' => 1,
            'product_id' => 1,
            'warehouse_location_id' => 1,
            'old_quantity' => 50,
            'new_quantity' => 45,
            'difference' => 5,
        ]);
    }
}
