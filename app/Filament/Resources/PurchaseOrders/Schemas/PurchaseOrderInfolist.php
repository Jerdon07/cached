<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurchaseOrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make('Details')
                    ->columnSpan(function ($record) {
                        if ($record->approved_by) {
                            return 5;
                        } else {
                            return 'full';
                        }
                    })
                    ->schema([
                        TextEntry::make('createdBy.name')
                            ->numeric()
                            ->placeholder('-')
                            ->belowContent(fn ($record) => "| $record->notes")
                            ->inlineLabel(fn ($record) => ! $record->approved_by),
                        TextEntry::make('supplier.company_name')
                            ->inlineLabel()
                            ->label('Supplier: '),
                        TextEntry::make('status')
                            ->inlineLabel()
                            ->label('Status: ')
                            ->badge(),
                    ]),

                Section::make('Order Information')
                    ->hidden(fn ($record) => ! $record?->approved_by)
                    ->columnSpan(7)
                    ->inlineLabel()
                    ->schema([
                        TextEntry::make('approvedBy.name')
                            ->label('Approved by:')
                            ->numeric()
                            ->hidden(fn ($record) => ! $record?->approved_by),
                        TextEntry::make('order_date')
                            ->label('Ordered Date:')
                            ->date()
                            ->hidden(fn ($record) => ! $record?->approved_by),
                        TextEntry::make('expected_delivery_date')
                            ->label('Expected Delivery Date:')
                            ->date()
                            ->hidden(fn ($record) => ! $record?->approved_by),
                        TextEntry::make('approved_at')
                            ->label('Approved at:')
                            ->date()
                            ->hidden(fn ($record) => ! $record?->approved_by),
                    ]),

                Section::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
