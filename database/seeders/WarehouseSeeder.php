<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            ['name' => 'Main Warehouse', 'address' => 'Baguio', 'description' => 'the main branch'],
            ['name' => 'Second Warehouse', 'address' => 'La Trinidad', 'description' => 'the second warehouse'],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::firstOrCreate($warehouse);
        }

        Warehouse::factory(5)->create();
    }
}
