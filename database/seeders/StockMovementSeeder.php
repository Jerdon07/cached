<?php

namespace Database\Seeders;

use App\Models\StockMovement;
use App\StockMovementType;
use Illuminate\Database\Seeder;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        StockMovement::firstOrCreate([
            'product_id' => 1,
            'warehouse_location_id' => 1,
        ], [
            'movement_type' => StockMovementType::Sale,
            'quantity' => -20.00,
            'performed_by' => 1,
            'notes' => 'The product stock movement for this is sale.',
        ]);
    }
}
