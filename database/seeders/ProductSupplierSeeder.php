<?php

namespace Database\Seeders;

use App\Models\ProductSupplier;
use Illuminate\Database\Seeder;

class ProductSupplierSeeder extends Seeder
{
    public function run(): void
    {
        ProductSupplier::firstOrCreate([
            'product_id' => 1,
            'supplier_id' => 1,
        ], [
            'supplier_sku' => 'ZA1203X0',
            'cost_price' => 50.00,
            'preferred' => true,
        ]);
    }
}
