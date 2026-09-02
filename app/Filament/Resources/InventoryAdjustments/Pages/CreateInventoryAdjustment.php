<?php

namespace App\Filament\Resources\InventoryAdjustments\Pages;

use App\Filament\Resources\InventoryAdjustments\InventoryAdjustmentResource;
use App\InventoryAdjustmentStatus;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreateInventoryAdjustment extends CreateRecord
{
    protected static string $resource = InventoryAdjustmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = InventoryAdjustmentStatus::Pending;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
