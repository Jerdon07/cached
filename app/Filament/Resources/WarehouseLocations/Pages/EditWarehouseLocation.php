<?php

namespace App\Filament\Resources\WarehouseLocations\Pages;

use App\Filament\Resources\WarehouseLocations\WarehouseLocationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditWarehouseLocation extends EditRecord
{
    protected static string $resource = WarehouseLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
