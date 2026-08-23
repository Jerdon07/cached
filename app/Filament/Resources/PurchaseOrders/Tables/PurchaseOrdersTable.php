<?php

namespace App\Filament\Resources\PurchaseOrders\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchaseOrder'),
                TextColumn::make('supplier.company_name')
                    ->searchable(),
                TextColumn::make('createdBy.name')
                    ->sortable(),
                TextColumn::make('approvedBy.name')
                    ->sortable(),
                TextColumn::make('order_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('expected_delivery_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('approved_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('approved_by')
                    ->label('Approval status')
                    ->placeholder('All')
                    ->trueLabel('Approved')
                    ->falseLabel('Not Approved')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('approved_by'),
                        false: fn (Builder $query) => $query->whereNull('approved_by'),
                        blank: fn (Builder $query) => $query,
                    ),
                Filter::make('created_by_me')
                    ->query(fn (Builder $query) => $query->where('created_by', '=', auth()->user()->id)),
            ])
            ->recordActions(
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            )
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
