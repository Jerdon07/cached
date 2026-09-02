<?php

namespace App\Filament\Resources\InventoryAdjustments\Schemas;

use App\InventoryAdjustmentReason;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class InventoryAdjustmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reason')
                    ->options(InventoryAdjustmentReason::class)
                    ->required(),
                Textarea::make('notes'),
                Repeater::make('items')
                    ->relationship('items')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->live(),
                        Select::make('warehouse_location_id')
                            ->relationship(
                                name: 'warehouseLocation',
                                titleAttribute: 'id',
                                modifyQueryUsing: fn (Builder $query, Get $get) => $query->whereHas('items', fn ($q) => $q->where('product_id', $get('product_id'))),
                            )->getOptionLabelFromRecordUsing(fn ($record) => $record->full_location)
                            ->required()
                            ->disabled(fn (Get $get) => ! $get('product_id')),
                        TextInput::make('old_quantity')
                            ->numeric()
                            ->required(),
                        TextInput::make('new_quantity')
                            ->numeric()
                            ->required()
                            ->live(true)
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $old = (float) ($get('old_quantity') ?? 0);
                                $new = (float) ($state ?? 0);

                                $set('difference', $new - $old);
                            }),
                        TextInput::make('difference')
                            ->numeric(),
                    ]),
            ]);
    }
}
