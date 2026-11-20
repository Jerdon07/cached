<?php

namespace Database\Seeders;

use App\Models\ProductSupplier;
use Illuminate\Database\Seeder;

class ProductSupplierSeeder extends Seeder
{
    public function run(): void
    {
        ProductSupplier::factory(50)->create();
    }
}
