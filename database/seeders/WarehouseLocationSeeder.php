<?php

namespace Database\Seeders;

use App\Models\WarehouseLocation;
use Illuminate\Database\Seeder;

class WarehouseLocationSeeder extends Seeder
{
    public function run(): void
    {
        WarehouseLocation::firstOrCreate([
            'warehouse_id' => 1,
            'zone' => 'Zone A',
            'aisle' => 'Aisle 2',
            'rack' => 'Rack B',
            'shelf' => 'Shelf 3',
            'bin' => 'Bin C',
            'description' => 'A location for this warehouse.',
        ]);

        WarehouseLocation::factory(40)->create();
    }
}
