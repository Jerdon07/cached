<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $administrator = Role::where('name', 'System Administrator')->firstOrFail();

        $administrator->permissions()->sync(
            Permission::whereIn('name', [
                /* ADMINISTRATIVE ACTIONS */
                'view_permissions',
                'view_any_permissions',
                'view_roles',
                'view_any_roles',
                'created_roles',
                'update_roles',
                'delete_roles',

                /* CATALOG */
                'view_products',
                'view_any_products',
                'create_products',
                'update_products',
                'delete_products',
                'delete_any_products',
                'restore_products',
                'restore_any_products',

                'view_categories',
                'view_any_categories',
                'create_categories',
                'update_categories',
                'delete_categories',
                'delete_any_categories',
                'restore_categories',
                'restore_any_categories',

                'view_brands',
                'view_any_brands',
                'create_brands',
                'update_brands',
                'delete_brands',
                'delete_any_brands',
                'restore_brands',
                'restore_any_brands',

                'view_units',
                'view_any_units',
                'create_units',
                'update_units',
                'delete_units',
                'delete_any_units',
                'restore_units',
                'restore_any_units',

                'view_any_users',
                'view_users',
                'create_users',
                'update_users',
                'delete_users',
                'delete_any_users',
                'restore_users',
                'restore_any_users',

                'view_roles',
                'view_any_roles',
                'create_roles',
                'update_roles',
                'delete_roles',
                'delete_any_roles',
                'restore_roles',
                'restore_any_roles',
                
                'view_suppliers',
                'view_any_suppliers',
                'create_suppliers',
                'update_suppliers',
                'delete_suppliers',
                'delete_any_suppliers',
                'restore_suppliers',
                'restore_any_suppliers',

                'view_customers',
                'view_any_customers',
                'create_customers',
                'update_customers',
                'delete_customers',
                'delete_any_customers',
                'restore_customers',
                'restore_any_customers',

                'view_purchase_orders',
                'view_any_purchase_orders',

                'view_purchase_order_items',
                'view_any_purchase_order_items',
                'create_purchase_order_items',
                'update_purchase_order_items',
                'delete_purchase_order_items',
                'delete_any_purchase_order_items',
                'restore_purchase_order_items',
                'restore_any_purchase_order_items',

                'view_goods_receipts',
                'view_goods_receipts',

                'view_warehouses',
                'view_any_warehouses',
                'create_warehouses',
                'update_warehouses',
                'delete_warehouses',
                'delete_any_warehouses',
                'restore_warehouses',
                'restore_any_warehouses',

                'view_warehouse_locations',
                'view_any_warehouse_locations',
                'create_warehouse_locations',
                'update_warehouse_locations',
                'delete_warehouse_locations',
                'delete_any_warehouse_locations',
                'restore_warehouse_locations',
                'restore_any_warehouse_locations',

                'view_stock_movements',
                'view_stock_movements',

                'view_inventory_adjustments',
                'view_any_inventory_adjustments',
                'create_inventory_adjustments',
                'update_inventory_adjustments',
                'delete_inventory_adjustments',
                'delete_any_inventory_adjustments',
                'restore_inventory_adjustments',
                'restore_any_inventory_adjustments',

                'view_sales_orders',
                'view_sales_orders',

                'view_sales_order_items',
                'view_sales_order_items',

                'view_audit_logs',
                'view_audit_logs',
            ])->pluck('id')
        );
    }
}
