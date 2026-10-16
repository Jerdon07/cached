<?php

namespace App\Filament\Resources\PurchaseOrders\Actions;

use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Models\WarehouseLocation;
use App\PurchaseOrderStatus;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Gate;

class ReceiveGoodsAction {
    public static function make(): Action
    {
        return Action::make('receive')
            ->label('Receive Goods')
            ->icon(Heroicon::Cube)
            ->color('success')
            ->visible(fn (PurchaseOrder $record): bool => 
                $record->status === PurchaseOrderStatus::Approved && 
                Gate::allows('create', GoodsReceipt::class)
            )
            ->mountUsing(function (Schema $form, PurchaseOrder $record) {
                $form->fill([
                    'items' => $record->items->map(fn ($item) => [
                        'purchase_order_item_id' => $item->id,
                        'product_name' => $item->product->name ?? 'N/A',
                        'quantity_received' => $item->quantity,
                    ])->toArray()
                ]);
            })
            ->schema([
                Repeater::make('items')
                    ->label('Goods Receipt Items')
                    ->schema([
                        Hidden::make('purchase_order_item_id'),

                        TextInput::make('product_name')
                            ->label('Product')
                            ->disabled()
                            ->dehydrated(),

                        Select::make('warehouse_location_id')
                            ->label('Warehouse Location')
                            ->options(WarehouseLocation::pluck('zone', 'id'))
                            ->required(),

                        TextInput::make('quantity_received')
                            ->label('Quantity Received')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(3),
                Textarea::make('remarks')
            ])
            ->action(function (PurchaseOrder $record, array $data) {
                $goodsReceipt = GoodsReceipt::create([
                    'purchase_order_id' => $record->id,
                    'received_date' => now(),
                    'received_by' => auth()->id(),
                    'remarks' => $data['remarks'] ?? null,
                ]);

                foreach ($data['items'] as $itemData) {
                    $goodsReceipt->items()->create([
                        'purchase_order_item_id' => $itemData['purchase_order_item_id'],
                        'warehouse_location_id' => $itemData['warehouse_location_id'],
                        'quantity_received' => $itemData['quantity_received'],
                    ]);
                }
            });
    }
}