<?php

namespace Database\Seeders;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Illuminate\Database\Seeder;

class StockTransferSeeder extends Seeder
{
    public function run(): void
    {
        StockTransfer::create([
            'from_warehouse_id' => 1,
            'to_warehouse_id' => 1,
            'status' => StockTransferStatus::Pending,
            'requested_by' => 1,
            'approved_by' => 1,
        ]);
    }
}
