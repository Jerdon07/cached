<?php

namespace Database\Seeders;

use App\InventoryAdjustmentReason;
use App\InventoryAdjustmentStatus;
use App\Models\InventoryAdjustment;
use Illuminate\Database\Seeder;

class InventoryAdjustmentSeeder extends Seeder
{
    public function run(): void
    {
        InventoryAdjustment::firstOrCreate([
            'status' => InventoryAdjustmentStatus::Pending,
        ], [
            'reason' => InventoryAdjustmentReason::Damaged,
            'created_by' => 1,
            'approved_by' => 1,
            'approved_at' => now(),
            'notes' => 'The product is damaged',
        ]);
    }
}
