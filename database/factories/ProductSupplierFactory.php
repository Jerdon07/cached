<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductSupplier>
 */
class ProductSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'supplier_id' => Supplier::query()->inRandomOrder()->value('id'),
            'supplier_sku' => fake()->sha256(),
            'cost_price' => fake()->numberBetween(1, 100),
            'preferred' => fake()->boolean(20),
        ];
    }
}
