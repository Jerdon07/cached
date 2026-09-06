<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use App\PurchaseOrderStatus;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseOrder::factory(20)->create();
    }
}
