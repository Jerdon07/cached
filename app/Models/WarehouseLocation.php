<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['warehouse_id', 'zone', 'aisle', 'rack', 'shelf', 'bin', 'description'])]
class WarehouseLocation extends Model
{
    use HasFactory, SoftDeletes;

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function goodsReceiptItems(): HasMany
    {
        return $this->hasMany(GoodsReceiptItem::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InventoryAdjustmentItem::class);
    }

    public function getFullLocationAttribute(): string
    {
        return collect([
            $this->zone,
            $this->aisle,
            $this->rack,
            $this->shelf,
            $this->bin,
        ])->filter()->implode(' ');
    }
}
