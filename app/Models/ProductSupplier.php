<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'supplier_id', 'supplier_sku', 'cost_price', 'preferred'])]
class ProductSupplier extends Model
{
    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
