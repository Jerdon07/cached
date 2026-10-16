<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseStaffPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $officer = Role::where('name', 'Warehouse Staff')->firstOrFail();

        $officer->permissions()->sync(
            Permission::whereIn('name', [
                'view_any_purchase_orders',
                'view_purchase_orders',

                'view_any_purchase_order_items',
                'view_purchase_order_items',

                'receive_goods',
                
                'view_any_goods_receipts',
                'view_goods_receipts',
                'create_goods_receipts',
                'update_goods_receipts',
            ])->pluck('id')
        );
    }
}
