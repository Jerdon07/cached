<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use App\PurchaseOrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Illuminate\Support\weeks;

/**
 * @extends Factory<PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $deliveryDate = fake()->optional()->dateTimeBetween('+1 week', '+4 week');

        return [
            'supplier_id' => Supplier::inRandomOrder()->value('id'),
            'order_date' => now()->subDay(),
            'approved_at' => fake()->optional(0.33)->dateTimeBetween('now', '+1 week'),
            'expected_delivery_date' => $deliveryDate,
            'status' => $deliveryDate
                ? PurchaseOrderStatus::Approved
                : PurchaseOrderStatus::Pending,
            'notes' => fake()->optional()->sentence(),
            'created_by' => User::whereHas(
                'roles.permissions',
                fn ($query) => $query
                    ->where('name', 'create_purchase_orders'))
                ->inRandomOrder()
                ->value('id')
        ];
    }
}
