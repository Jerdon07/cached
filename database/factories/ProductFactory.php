<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'brand_id' => Brand::inRandomOrder()->value('id'),
            'unit_id' => Unit::inRandomOrder()->value('id'),
            'name' => fake()->unique()->word(),
            'sku' => fake()->ean13(),
            'barcode' => fake()->isbn10(),
            'description' => fake()->sentence(),
            'selling_price' => fake()->numberBetween(5, 500),
            'minimum_stock' => fake()->numberBetween(5, 20),
            'is_active' => fake()->boolean(80),
        ];
    }
}
