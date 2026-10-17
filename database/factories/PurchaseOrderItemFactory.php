<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderItemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_order_id' => PurchaseOrder::inRandomOrder()->value('id'),
            'product_id' => Product::inRandomOrder()->value('id'),
            'quantity' => fake()->numberBetween(1, 100),
            'unit_cost' => fake()->numberBetween(1, 100),
        ];
    }
}
