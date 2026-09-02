<?php

namespace App\Filament\Resources\StockMovements\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name'),
                TextColumn::make('warehouseLocation.warehouse.name'),
                TextColumn::make('warehouseLocation.zone')
                    ->label('Location'),
            ])
            ->filters([
                //
            ]);
    }
}
