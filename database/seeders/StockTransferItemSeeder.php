<?php

namespace Database\Seeders;

use App\Models\StockTransferItem;
use Illuminate\Database\Seeder;

class StockTransferItemSeeder extends Seeder
{
    public function run(): void
    {
        StockTransferItem::create([
            'stock_transfer_id' => 1,
            'product_id' => 1,
            'quantity' => 5,
        ]);
    }
}
