<?php

namespace App\Filament\Resources\WarehouseLocations\Pages;

use App\Filament\Resources\WarehouseLocations\WarehouseLocationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWarehouseLocation extends ViewRecord
{
    protected static string $resource = WarehouseLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
