<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            /* User & Access */
            RoleSeeder::class,
            PermissionSeeder::class,
            AdministratorPermissionSeeder::class,
            PurchasingOfficerPermissionSeeder::class,
            PurchasingManagerPermissionSeeder::class,
            UserSeeder::class,

            CategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,

            SupplierSeeder::class,
            CustomerSeeder::class,

            WarehouseSeeder::class,
            WarehouseLocationSeeder::class,

            ProductSeeder::class,
            ProductSupplierSeeder::class,

            PurchaseOrderSeeder::class,
            PurchaseOrderItemSeeder::class,

            GoodsReceiptSeeder::class,
            GoodsReceiptItemSeeder::class,

            StockMovementSeeder::class,

            InventoryAdjustmentSeeder::class,
            InventoryAdjustmentItemSeeder::class,

            StockTransferSeeder::class,
            StockTransferItemSeeder::class,

            SalesOrderSeeder::class,
            SalesOrderItemSeeder::class,

            AuditLogSeeder::class,
        ]);
    }
}
