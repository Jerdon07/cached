<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchasingManagerPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $purchasingManager = Role::where('name', 'Purchasing Manager')->firstOrFail();

        $purchasingManager->permissions()->sync(
            Permission::whereIn('name', [
                'view_any_suppliers',
                'view_suppliers',
                'create_suppliers',
                'update_suppliers',
                'delete_suppliers',
                'delete_any_suppliers',

                'view_any_purchase_orders',
                'view_purchase_orders',
                'approve_purchase_orders',
                'reject_purchase_orders',
                'send_purchase_orders',
                'close_purchase_orders',

                'view_any_purchase_order_items',
                'view_purchase_order_items',

                'create_goods_receipts',
                'create_goods_receipt_items',
            ])->pluck('id'),
        );
    }
}
