<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PurchasingOfficerPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $purchasingOfficer = Role::where('name', 'Purchasing Officer')->firstOrFail();

        $purchasingOfficer->permissions()->sync(
            Permission::whereIn('name', [
                'view_any_products',
                'view_products',
                'view_any_categories',
                'view_categories',

                'view_any_suppliers',
                'view_suppliers',
                'create_suppliers',
                'update_suppliers',
                'delete_suppliers',
                'delete_any_suppliers',

                'view_any_purchase_orders',
                'view_purchase_orders',
                'create_purchase_orders',
                'update_purchase_orders',
                'delete_purchase_orders',
                'delete_any_purchase_orders',

                'view_any_purchase_order_items',
                'view_purchase_order_items',
                'create_purchase_order_items',
                'update_purchase_order_items',
                'delete_purchase_order_items',
                'delete_any_purchase_order_items',

                'view_any_goods_receipts',
                'view_goods_receipts',

                'view_any_warehouses',
                'view_warehouses',

                'view_any_warehouse_locations',
                'view_warehouse_locations',

                'view_any_stock_movements',
                'view_stock_movements',
            ])->pluck('id')
        );
    }
}
