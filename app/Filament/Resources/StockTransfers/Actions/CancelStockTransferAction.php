<?php

namespace App\Filament\Resources\StockTransfers\Actions;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class CancelStockTransferAction
{
    public static function make(): Action
    {
        return Action::make('cancel')
            ->icon(Heroicon::XCircle)
            ->requiresConfirmation()
            ->visible(fn (StockTransfer $record): bool => auth()->user()->can('cancel', $record))
            ->action(function (StockTransfer $record) {
                $record->update([
                    'status' => StockTransferStatus::Cancelled,
                ]);
            });
    }
}
