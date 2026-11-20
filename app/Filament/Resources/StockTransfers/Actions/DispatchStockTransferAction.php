<?php

namespace App\Filament\Resources\StockTransfers\Actions;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class DispatchStockTransferAction
{
    public static function make(): Action
    {
        return Action::make('transfer')
            ->icon(Heroicon::ArrowsRightLeft)
            ->visible(fn (StockTransfer $record): bool => auth()->user()->can('dispatch', $record))
            ->action(function (StockTransfer $record) {
                $record->update([
                    'status' => StockTransferStatus::InTransit
                ]);
            });
    }
}