<?php

namespace App\Filament\Resources\StockTransfers\Schemas;

use App\Models\StockMovement;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class StockTransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('from_warehouse_id')
                    ->relationship('fromWarehouse', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('items', [])),
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
                            ->relationship(
                                name: 'product',
                                titleAttribute: 'name',
                                modifyQueryUsing: function (Builder $query, Get $get): Builder {
                                    $warehouseId = $get('../../from_warehouse_id');

                                    if (! $warehouseId) {
                                        return $query->whereRaw('1 = 0');
                                    }

                                    return $query->whereIn('products.id', StockMovement::query()
                                        ->select('product_id')
                                        ->whereHas('warehouseLocation', fn (Builder $q) => $q->where('warehouse_id', $warehouseId))
                                        ->groupBy('product_id')
                                        ->havingRaw('SUM(quantity) > 0'));
                                },
                            )
                            ->required(),
                        TextInput::make('quantity')
                            ->numeric()
                            ->required(),
                    ]),
            ]);
    }
}
