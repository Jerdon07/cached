<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate(
            ['name' => 'ProductName'],
            [
                'category_id' => 1,
                'brand_id' => 1,
                'unit_id' => 1,
                'sku' => 'Z023AX10',
                'barcode' => '0123456789012',
                'description' => 'A product from the warehouse.',
                'selling_price' => 99.00,
                'minimum_stock' => 5,
                'is_active' => true,
            ]
        );

        Product::factory(30)->create();
    }
}
