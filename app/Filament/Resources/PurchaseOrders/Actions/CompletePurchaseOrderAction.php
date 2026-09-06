<?php

namespace App\Filament\Resources\PurchaseOrders\Actions;

use App\Models\PurchaseOrder;
use App\PurchaseOrderStatus;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Icons\Heroicon;

class CompletePurchaseOrderAction {
    public static function make(): Action
    {
        return Action::make('complete')
            ->icon(Heroicon::CheckCircle)
            ->authorize('complete')
            ->requiresConfirmation()
            ->schema([
                DatePicker::make('delivery_date')
                    ->maxDate(today())
            ])
            ->action(fn (PurchaseOrder $record) => $record->update([
                'status' => PurchaseOrderStatus::Completed
            ]));
    }
}