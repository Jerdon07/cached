<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseManagerPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $manager = Role::where('name', 'Warehouse Manager')->firstOrFail();

        $manager->permissions()->sync(
            Permission::whereIn('name', [
                'view_purchase_orders',
                'view_any_purchase_orders',

                'view_purchase_order_items',
                'view_any_purchase_order_items',

                'view_warehouses',
                'view_any_warehouses',
                'create_warehouses',
                'update_warehouses',
                'delete_warehouses',
                'update_any_warehouses',
                'restore_warehouses',
                'restore_any_warehouses',

                'view_warehouse_locations',
                'view_any_warehouse_locations',
                'create_warehouse_locations',
                'update_warehouse_locations',
                'delete_warehouse_locations',
                'update_any_warehouse_locations',
                'restore_warehouse_locations',
                'restore_any_warehouse_locations',
                
            ])->pluck('id')
        );
    }
}
