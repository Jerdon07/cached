<?php

namespace App\Filament\Resources\WarehouseLocations\Schemas;

use App\Models\Warehouse;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WarehouseLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('warehouse_id')
                    ->label('Warehouse')
                    ->options(Warehouse::query()->pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('zone'),
                TextInput::make('aisle'),
                TextInput::make('rack'),
                TextInput::make('shelf'),
                TextInput::make('bin'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
