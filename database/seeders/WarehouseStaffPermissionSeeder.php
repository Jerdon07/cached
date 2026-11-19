<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class WarehouseStaffPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $officer = Role::where('name', 'Warehouse Staff')->firstOrFail();

        $officer->permissions()->sync(
            Permission::whereIn('name', [
                /* PurchaseOrder */
                'view_any_purchase_orders',
                'view_purchase_orders',

                /* PurchaseOrderItem */
                'view_any_purchase_order_items',
                'view_purchase_order_items',

                /* GoodsReceipt */
                'view_any_goods_receipts',
                'view_goods_receipts',
                'create_goods_receipts',
                'update_goods_receipts',

                /* GoodsReceiptItem */
                'view_any_goods_receipt_items',
                'view_goods_receipt_items',

                /* Warehouse */
                'view_warehouses',
                'view_any_warehouses',

                /* WarehouseLocation */
                'view_warehouse_locations',
                'view_any_warehouse_locations',

                /* StockMovement */
                'view_any_stock_movements',
                'view_stock_movements',
            ])->pluck('id')
        );
    }
}
