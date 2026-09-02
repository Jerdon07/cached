<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['company_name' => 'Macrohard', 'contact_person' => 'James Bond', 'phone' => '09303997215', 'email' => 'supplier@example.com', 'address' => 'New York', 'city' => 'Tokyo', 'province' => 'Benguet', 'postal_code' => '2601', 'remarks' => 'lorem ipsum'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(['email' => $supplier['email']], $supplier);
        }

        Supplier::factory(10)->create();
    }
}
