<?php

namespace App\Models;

use App\PurchaseOrderStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['supplier_id', 'order_date', 'expected_delivery_date', 'status', 'notes', 'created_by', 'approved_by', 'approved_at'])]
class PurchaseOrder extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'order_date' => 'date',
            'expected_delivery_date' => 'date',
            'status' => PurchaseOrderStatus::class,
            'approved_at' => 'date',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function goodsReceipt(): HasMany
    {
        return $this->hasMany(GoodsReceipt::class);
    }

    public function getPurchaseOrderAttribute(): string
    {
        return 'PO-'.str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function syncReceivingStatus(): void
    {
        $receivable = [PurchaseOrderStatus::Approved, PurchaseOrderStatus::PartiallyReceived];

        if (! in_array($this->status, $receivable, true)) {
            return;
        }

        // Sum the quantity of the received goods
        $items = $this->items()
            ->withSum('goodsReceiptItems as received_quantity', 'quantity_received')
            ->get();

        // Check if there's a received quantity of goods
        $anyReceived = $items->contains(
            fn (PurchaseOrderItem $item): bool => bccomp((string) ($item->received_quantity ?? 0), '0', 3) === 1
        );

        // Check if the received quantity is equal to the ordered quantity
        $allFulfilled = $items->isNotEmpty() &&  $items->every(
            fn (PurchaseOrderItem $item): bool => bccomp((string) ($item->received_quantity ?? 0), (string) $item->quantity, 3) >= 0
        );

        // Update status depending on the result
        $newStatus = match (true) {
            $allFulfilled => PurchaseOrderStatus::Closed,
            $anyReceived => PurchaseOrderStatus::PartiallyReceived,
            default => PurchaseOrderStatus::Approved,
        };

        // Update only if the current status is not the new status
        if ($newStatus !== $this->status) {
            $this->update(['status' => $newStatus]);
        }
    }
}
