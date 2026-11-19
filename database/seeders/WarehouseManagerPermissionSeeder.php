<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class WarehouseManagerPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $manager = Role::where('name', 'Warehouse Manager')->firstOrFail();

        $manager->permissions()->sync(
            Permission::whereIn('name', [
                /* PurchaseOrder */
                'view_purchase_orders',
                'view_any_purchase_orders',

                /* PurchaseOrderItem */
                'view_purchase_order_items',
                'view_any_purchase_order_items',

                /* GoodsReceipt */
                'view_any_goods_receipts',
                'view_goods_receipts',

                /* GoodsReceiptItem */
                'view_any_goods_receipt_items',
                'view_goods_receipt_items',

                /* Warehouse */
                'view_warehouses',
                'view_any_warehouses',
                'create_warehouses',
                'update_warehouses',
                'delete_warehouses',
                'update_any_warehouses',
                'restore_warehouses',
                'restore_any_warehouses',

                /* WarehouseLocation */
                'view_warehouse_locations',
                'view_any_warehouse_locations',
                'create_warehouse_locations',
                'update_warehouse_locations',
                'delete_warehouse_locations',
                'update_any_warehouse_locations',
                'restore_warehouse_locations',
                'restore_any_warehouse_locations',

                /* StockMovement */
                'view_any_stock_movements',
                'view_stock_movements',
            ])->pluck('id')
        );
    }
}
