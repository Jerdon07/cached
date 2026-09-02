<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();

        Product::factory(30)
            ->hasAttached(
                factory: $suppliers->random(5),
                pivot: fn () => [
                    'cost_price' => fake()->randomFloat(2, 10, 500),
                    'preferred' => fake()->boolean(10),
                ]
            )->create();
    }
}
