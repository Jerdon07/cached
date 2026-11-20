<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\WarehouseLocation;
use App\StockMovementType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockMovement>
 */
class StockMovementFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'warehouse_location_id' => WarehouseLocation::query()->inRandomOrder()->value('id'),
            'performed_by' => User::query()->inRandomOrder()->value('id'),
            'movement_type' => fake()->randomElement(StockMovementType::cases()),
            'quantity' => fake()->numberBetween(1, 100),
            'notes' => fake()->sentence(),
        ];
    }
}
