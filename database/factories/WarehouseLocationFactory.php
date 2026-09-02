<?php

namespace Database\Factories;

use App\Models\Warehouse;
use App\Models\WarehouseLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WarehouseLocation>
 */
class WarehouseLocationFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warehouse_id' => Warehouse::factory(),
            'zone' => fake()->randomElement(['A', 'B', 'C', 'D', 'E']),
            'aisle' => sprintf('%02d', fake()->numberBetween(1, 20)),
            'rack' => sprintf('%02d', fake()->numberBetween(1, 10)),
            'shelf' => (string) fake()->numberBetween(1, 5),
            'bin' => sprintf('%02d', fake()->numberBetween(1, 50)),
            'description' => fake()->optional(0.3)->sentence(),
        ];
    }
}
