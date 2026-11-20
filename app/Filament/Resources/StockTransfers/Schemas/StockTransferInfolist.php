<?php

namespace App\Filament\Resources\StockTransfers\Schemas;

use App\StockTransferStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StockTransferInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('fromWarehouse.name')
                    ->label('From'),
                TextEntry::make('toWarehouse.name')
                    ->label('To'),
                TextEntry::make('transfer_number'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('requestedBy.name'),
                TextEntry::make('approvedBy.name')
                    ->hidden(fn ($record) => $record->status === StockTransferStatus::Pending),
            ]);
    }
}
