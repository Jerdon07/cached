<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'System Administrator', 'description' => 'Manages the system, users, and configuration'],
            ['name' => 'Purchasing Officer', 'description' => 'Buys inventory from suppliers'],
            ['name' => 'Purchasing Manager', 'description' => 'Approves purchases.'],
            ['name' => 'Warehouse Manager', 'description' => 'Responsible for warehouse operations'],
            ['name' => 'Warehouse Staff', 'description' => 'Physical warehouse workers'],
            ['name' => 'Sales Representative', 'description' => 'Handles customer orders'],
            ['name' => 'Sales Manager', 'description' => 'Approves sales'],
            ['name' => 'Inventory Controller', 'description' => 'Maintains inventory accuracy'],
            ['name' => 'Finance Officer', 'description' => 'Responsible for financial records'],
            ['name' => 'General Manager', 'description' => 'Highest business authority'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
