<?php

namespace App\Filament\Resources\GoodsReceipts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GoodsReceiptInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('purchaseOrder.purchaseOrder')
                    ->label('Purchase order'),
                TextEntry::make('purchaseOrder.supplier.company_name')
                    ->label('Supplier'),
                TextEntry::make('receivedBy.name')
                    ->label('Reeived by'),
                TextEntry::make('received_date')
                    ->date(),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
