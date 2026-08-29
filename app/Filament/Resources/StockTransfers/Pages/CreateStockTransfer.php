<?php

namespace App\Filament\Resources\StockTransfers\Pages;

use App\Filament\Resources\StockTransfers\StockTransferResource;
use App\StockTransferStatus;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreateStockTransfer extends CreateRecord
{
    protected static string $resource = StockTransferResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['requested_by'] = auth()->user()->id;
        $data['status'] = StockTransferStatus::Pending;

        return $data;
    }
}
