<?php

namespace App\Filament\Resources\WarehouseLocations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WarehouseLocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('warehouse.name'),
                TextEntry::make('zone'),
                TextEntry::make('aisle'),
                TextEntry::make('rack'),
                TextEntry::make('shelf'),
                TextEntry::make('bin'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                
            ]);
    }
}
