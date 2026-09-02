<?php

namespace App\Filament\Resources\StockTransfers\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockTransfersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transferNumber')
                    ->label('Number'),
                TextColumn::make('fromWarehouse.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('toWarehouse.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('requestedBy.name')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('approvedBy.name')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Items'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
