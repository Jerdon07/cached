<?php

namespace App\Models;

use App\InventoryAdjustmentReason;
use App\InventoryAdjustmentStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['reason', 'status', 'created_by', 'approved_by', 'approved_at', 'notes'])]
class InventoryAdjustment extends Model
{
    protected function casts(): array
    {
        return [
            'reason' => InventoryAdjustmentReason::class,
            'status' => InventoryAdjustmentStatus::class,
            'approved_at' => 'date',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(InventoryAdjustmentItem::class);
    }

    public function getAdjustmentNumberAttribute(): string
    {
        return 'IA-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
