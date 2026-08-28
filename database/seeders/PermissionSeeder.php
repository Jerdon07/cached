<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $resources = [
            // Access Control
            'users',
            'roles',

            // Catalog
            'products',
            'categories',
            'brands',
            'units',

            // Purchasing
            'suppliers',
            'purchase_orders',
            'purchase_order_items',
            'goods_receipts',
            'goods_receipt_items',

            // Warehousing
            'warehouses',
            'warehouse_locations',
            'stock_transfers',
            'stock_transfer_items',

            // Inventory
            'stock_movements',
            'inventory_adjustments',
            'inventory_adjustment_items',

            // Sales
            'customers',
            'sales_orders',
            'sales_order_items',

            // Audit
            'audit_logs',
        ];

        $actions = [
            'view_any',
            'view',
            'create',
            'update',
            'delete',
            'delete_any',
            'restore',
            'restore_any',
            'force_delete',
            'force_delete_any',
        ];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$resource}",
                ]);
            }
        }

        $customPermissions = [
            // Purchase Orders
            'approve_purchase_orders',
            'reject_purchase_orders',
            'send_purchase_orders', // I don't know what's the use
            'close_purchase_orders', // I don't know what's the use

            // Goods Receiving
            'receive_goods', // I don't know what's the use

            // Inventory Adjustments
            // Mirrors the purchase order workflow: draft -> submit -> approve/reject.
            // Without these, 'adjust_inventory' below is left to cover both
            // "propose an adjustment" and "approve an adjustment" for the same
            // user, which defeats segregation of duties.
            'submit_inventory_adjustments',
            'approve_inventory_adjustments',
            'reject_inventory_adjustments',

            // Stock Transfers
            // Same reasoning — StockTransferStatus has Pending/Approved/Rejected
            // states with nothing in the permission table to gate the transitions.
            'submit_stock_transfers',
            'approve_stock_transfers',
            'reject_stock_transfers',

            // Inventory (execution-level actions, distinct from the
            // approval permissions above)
            'adjust_inventory',
            'count_inventory',
            'transfer_stock',

            // Sales
            'approve_sales_orders',
            'cancel_sales_orders',

            // Reports
            'view_reports',
            'export_reports',

            // Dashboard
            'view_dashboard',

            // Audit
            'view_activity_logs',

            // Notifications
            'manage_notifications',
        ];

        foreach ($customPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }
    }
}