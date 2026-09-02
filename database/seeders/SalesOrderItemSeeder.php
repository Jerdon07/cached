<?php

namespace Database\Seeders;

use App\Models\SalesOrderItem;
use Illuminate\Database\Seeder;

class SalesOrderItemSeeder extends Seeder
{
    public function run(): void
    {
        SalesOrderItem::create([
            'sales_order_id' => 1,
            'product_id' => 1,
            'quantity' => 5.00,
            'unit_price' => 10.00,
        ]);
    }
}
