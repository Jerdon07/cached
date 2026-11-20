<?php

namespace App\Filament\Resources\StockTransfers\Actions;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class ApproveStockTransferAction
{
    public static function make(): Action
    {
        return Action::make('approve')
            ->requiresConfirmation()
            ->icon(Heroicon::Check)
            ->visible(fn (StockTransfer $record): bool => auth()->user()->can('approve', $record))
            ->action(function (StockTransfer $record) {
                $record->update([
                    'status' => StockTransferStatus::Approved,
                    'approved_by' => auth()->id(),
                ]);
            });
    }
}
