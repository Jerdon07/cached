<?php

namespace App\Filament\Resources\WarehouseLocations\Pages;

use App\Filament\Resources\WarehouseLocations\WarehouseLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWarehouseLocations extends ListRecords
{
    protected static string $resource = WarehouseLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
