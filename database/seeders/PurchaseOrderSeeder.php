<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use App\PurchaseOrderStatus;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseOrder::create([
            'supplier_id' => 1,
            'order_date' => now(),
            'expected_delivery_date' => now()->addDays(3),
            'status' => PurchaseOrderStatus::Pending,
            'notes' => 'A nice purchase order from a supplier.',
            'created_by' => 1,
            'approved_at' => now()->addHour(),
        ]);
    }
}
