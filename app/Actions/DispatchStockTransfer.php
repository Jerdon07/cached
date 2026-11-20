<?php

namespace App\Actions;

use App\Models\StockMovement;
use App\Models\StockTransfer;
use App\Models\User;
use App\Models\WarehouseLocation;
use App\StockMovementType;
use App\StockTransferStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DispatchStockTransfer
{
    public function handle(StockTransfer $transfer, array $lines, User $by): void
    {
        DB::transaction(function () use ($transfer, $lines, $by) {
            $transfer = StockTransfer::whereKey($transfer->id)->lockForUpdate()->firstOrFail();

            if ($transfer->status !== StockTransferStatus::Approved) {
                throw ValidationException::withMessages(['items' => 'Transfer is not approved.']);
            }

            foreach ($lines as $line) {
                $item = $transfer->items()->findOrFail($line['id']);
                $picked = '0';
                $seen = [];

                foreach ($line['picks'] as $pick) {
                    $locationId = $pick['warehouse_location_id'];
                    $qty = (string) $pick['quantity'];

                    if (in_array($locationId, $seen, true)) {
                        throw ValidationException::withMessages(['items' => 'Same location used twice for one product.']);
                    }
                    $seen[] = $locationId;

                    $location = WarehouseLocation::findOrFail($locationId);
                    if ($location->warehouse_id !== $transfer->from_warehouse_id) {
                        throw ValidationException::withMessages(['items' => 'Location is not in the source warehouse.']);
                    }

                    $onHand = (string) StockMovement::query()
                        ->where('product_id', $item->product_id)
                        ->whereBelongsTo($location)
                        ->sum('quantity');

                    if (bccomp($onHand, $qty, 3) < 0) {
                        throw ValidationException::withMessages(['items' => "Only {$onHand} on hand at {$location->full_location}."]);
                    }

                    $movement = $transfer->stockMovements()->create([
                        'product_id' => $item->product_id,
                        'warehouse_location_id' => $location->id,
                        'movement_type' => StockMovementType::TransferOut,
                        'quantity' => '-'.$qty,
                        'performed_by' => $by->id,
                    ]);

                    $item->picks()->create([
                        'warehouse_location_id' => $location->id,
                        'quantity' => $qty,
                        'stock_movement_id' => $movement->id,
                    ]);

                    $picked = bcadd($picked, $qty, 3);
                }

                if (bccomp($picked, (string) $item->quantity, 3) !== 0) {
                    throw ValidationException::withMessages(['items' => "Picks must total {$item->quantity}, got {$picked}."]);
                }
            }

            $transfer->update(['status' => StockTransferStatus::InTransit]);
        });
    }
}
