<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['category_id', 'brand_id', 'unit_id', 'name', 'sku', 'barcode', 'description', 'selling_price', 'minimum_stock', 'is_active'])]
class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'product_suppliers')
            ->withPivot([
                'supplier_sku',
                'cost_price',
                'preferred',
            ])
            ->withTimestamps();
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function inventoryAdjustmentItems(): HasMany
    {
        return $this->hasMany(InventoryAdjustmentItem::class);
    }

    public function salesOrderItems(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function scopeWithStockOnHand(Builder $query): void
    {
        $query->addSelect([
            'stock_on_hand' => StockMovement::query()
                ->selectRaw('COALESCE(SUM(quantity), 0)')
                ->whereColumn('product_id', $this->getTable().'.id'),
        ])->withCasts(['stock_on_hand' => 'decimal:3']);
    }

    public function scopeLowStock(Builder $query): void
    {
        $products = $this->getTable();
        $movements = (new StockMovement)->getTable();

        $query->whereRaw("(
            SELECT COALESCE(SUM(quantity), 0)
            FROM {$movements}
            WHERE {$movements}.product_id = {$products}.id
        ) < {$products}.minimum_stock");
    }
}
