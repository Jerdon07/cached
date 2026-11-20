<?php

namespace App\Filament\Resources\StockTransfers\Tables;

use App\Filament\Resources\StockTransfers\Actions\ApproveStockTransferAction;
use App\Filament\Resources\StockTransfers\Actions\BeginStockTransferAction;
use App\Filament\Resources\StockTransfers\Actions\CancelStockTransferAction;
use App\Filament\Resources\StockTransfers\Actions\RejectStockTransferAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
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
                ActionGroup::make([
                    ViewAction::make(),
                    ApproveStockTransferAction::make(),
                    RejectStockTransferAction::make(),
                    BeginStockTransferAction::make(),
                    CancelStockTransferAction::make(),
                    EditAction::make(),
                ]),
            ]);
    }
}
