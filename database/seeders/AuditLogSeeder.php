<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $actions = [
            'created',
            'updated',
            'deleted',
        ];

        foreach (range(1, 30) as $i) {
            $product = $products->random();

            AuditLog::create([
                'user_id' => $users->random()->id,
                'action' => $actions[array_rand($actions)],

                'auditable_type' => Product::class,
                'auditable_id' => $product->id,

                'old_values' => [
                    'name' => $product->name,
                    'minimum_stock' => $product->minimum_stock,
                    'selling_price' => $product->selling_price,
                ],

                'new_values' => [
                    'name' => $product->name,
                    'minimum_stock' => $product->minimum_stock,
                    'selling_price' => $product->selling_price,
                ],

                'ip_address' => fake()->ipv4(),
            ]);
        }
    }
}
