<?php

namespace App\Filament\Resources\StockTransfers\Actions;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class RejectStockTransferAction
{
    public static function make(): Action
    {
        return Action::make('reject')
            ->requiresConfirmation()
            ->icon(Heroicon::XCircle)
            ->visible(fn (StockTransfer $record): bool => auth()->user()->can('approve', $record))
            ->action(function (StockTransfer $record) {
                $record->update([
                    'status' => StockTransferStatus::Rejected,
                ]);
            });
    }
}