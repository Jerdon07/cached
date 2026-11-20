<?php

namespace App\Filament\Resources\WarehouseLocations\Schemas;

use App\Models\StockMovement;
use App\Models\WarehouseLocation;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class WarehouseLocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('description')
                    ->columnSpanFull()
                    ->hiddenLabel()
                    ->weight(FontWeight::SemiBold)
                    ->placeholder('-'),
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Details')
                            ->columns(5)
                            ->schema([
                                TextEntry::make('zone')
                                    ->placeholder('-'),
                                TextEntry::make('aisle')
                                    ->placeholder('-'),
                                TextEntry::make('rack')
                                    ->placeholder('-'),
                                TextEntry::make('shelf')
                                    ->placeholder('-'),
                                TextEntry::make('bin')
                                    ->placeholder('-'),
                            ]),
                        Tab::make('Items')
                            ->schema([
                                RepeatableEntry::make('stockedProducts')
                                    ->hiddenLabel()
                                    ->state(fn (WarehouseLocation $record) => StockMovement::query()
                                        ->selectRaw('product_id, SUM(quantity) as quantity')
                                        ->where('warehouse_location_id', $record->id)
                                        ->groupBy('product_id')
                                        ->havingRaw('SUM(quantity) > 0')
                                        ->with('product.unit')
                                        ->get())
                                    ->schema([
                                        TextEntry::make('product.name')
                                            ->label('Product Name'),
                                        TextEntry::make('quantity')
                                            ->label('Available Quantity')
                                            ->suffix(fn ($record) => $record->product->unit->abbreviation),
                                    ]),
                            ]),
                    ]),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (WarehouseLocation $record): bool => $record->trashed()),
            ]);
    }
}
