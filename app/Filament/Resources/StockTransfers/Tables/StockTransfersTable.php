<?php

namespace App\Filament\Resources\StockTransfers\Tables;

use App\Models\StockTransfer;
use App\StockTransferStatus;
use Filament\Actions\Action;
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
                    Action::make('Approve')
                        ->requiresConfirmation()
                        ->icon(Heroicon::Check)
                        ->visible(fn (StockTransfer $record): bool => auth()->user()->can('approve', $record))
                        ->action(function (StockTransfer $record) {
                            $record->update([
                                'status' => StockTransferStatus::Approved,
                                'approved_by' => auth()->id(),
                            ]);
                        }),
                    Action::make('Reject')
                        ->requiresConfirmation()
                        ->icon(Heroicon::XCircle)
                        ->visible(fn (StockTransfer $record): bool => auth()->user()->can('approve', $record))
                        ->action(function (StockTransfer $record) {
                            $record->update([
                                'status' => StockTransferStatus::Approved,
                            ]);
                        }),
                    EditAction::make(),
                ]),
            ]);
    }
}
