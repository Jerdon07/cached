<?php

namespace App\Filament\Resources\PurchaseOrders\Actions;

use App\Models\PurchaseOrder;
use App\PurchaseOrderStatus;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

use function Illuminate\Support\months;
use function Illuminate\Support\weeks;

class ApprovePurchaseOrderAction {
    public static function make(): Action
    {
        return Action::make('approve')
            ->icon(Heroicon::Check)
            ->authorize('approve')
            ->requiresConfirmation()
            ->schema([
                DatePicker::make('expected_delivery_date')
                    ->label('Expected Delivery Date')
                    ->minDate(today())
                    ->maxDate(weeks(3))
                    ->required(),
            ])
            ->action(fn (PurchaseOrder $record) => $record->update([
                'status' => PurchaseOrderStatus::Approved,
                'approved_by' => auth()->user()->id,
                'approved_at' => now(),
            ]))
            ->successNotification(Notification::make()
                ->success()
                ->title('Approved Successfully')
            );
    }
}