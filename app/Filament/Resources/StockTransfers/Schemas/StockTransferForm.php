<?php

namespace App\Filament\Resources\StockTransfers\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StockTransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('from_warehouse_id')
                    ->relationship('fromWarehouse', 'name')
                    ->required(),
                Select::make('to_warehouse_id')
                    ->relationship('toWarehouse', 'name')
                    ->required(),
                Repeater::make('items')
                    ->relationship('items')
                    ->hiddenOn('edit')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        TextInput::make('quantity')
                            ->numeric()
                            ->required(),
                    ])
            ]);
    }
}
