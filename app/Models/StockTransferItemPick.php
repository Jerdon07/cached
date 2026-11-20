<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['stock_transfer_item_id', 'warehouse_location_id','quantity'])]
class StockTransferItemPick extends Model
{
    public function item(): BelongsTo
    {
        return $this->belongsTo(StockTransferItem::class);
    }

    public function warehouseLocation(): BelongsTo
    {
        return $this->belongsTo(WarehouseLocation::class);
    }
}
