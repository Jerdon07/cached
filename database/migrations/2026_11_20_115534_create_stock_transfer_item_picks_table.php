<?php

use App\Models\StockTransferItem;
use App\Models\WarehouseLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transfer_item_picks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockTransferItem::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(WarehouseLocation::class)->constrained()->restrictOnDelete();
            $table->decimal('quantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_item_allocations');
    }
};
