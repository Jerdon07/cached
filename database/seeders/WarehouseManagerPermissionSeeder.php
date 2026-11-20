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
                'view_stock_movements',
                'view_any_stock_movements',

                /* StockTransfer */
                'view_stock_transfers',
                'view_any_stock_transfers',
                'create_stock_transfers',
                'update_stock_transfers',
                'delete_stock_transfers',
                'submit_stock_transfers',
                'approve_stock_transfers',
                'reject_stock_transfers',

                /* StockTransferItem */
                'view_stock_transfer_items',
                'view_any_stock_transfer_items',
                'create_stock_transfer_items',
                'update_stock_transfer_items',
                'delete_stock_transfer_items',
            ])->pluck('id')
        );
    }
}
