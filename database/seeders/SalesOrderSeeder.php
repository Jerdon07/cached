<?php

namespace Database\Seeders;

use App\Models\SalesOrder;
use App\SalesOrderStatus;
use Illuminate\Database\Seeder;

class SalesOrderSeeder extends Seeder
{
    public function run(): void
    {
        SalesOrder::create([
            'customer_id' => 1,
            'order_date' => now()->addDays(5),
            'status' => SalesOrderStatus::Pending,
        ]);
    }
}
