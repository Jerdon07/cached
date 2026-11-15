<?php

namespace App\Filament\Resources\PurchaseOrders\Actions;

use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptItem;
use App\Models\PurchaseOrder;
use App\Models\WarehouseLocation;
use App\PurchaseOrderStatus;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ReceiveGoodsAction
{
    public static function make(): Action
    {
        return Action::make('receive')
            ->label('Receive Goods')
            ->icon(Heroicon::Cube)
            ->color('success')
            ->visible(fn (PurchaseOrder $record): bool => (
                $record->status === PurchaseOrderStatus::Approved
                || $record->status === PurchaseOrderStatus::PartiallyReceived
            ) && Gate::allows('create', GoodsReceipt::class)
            )
            ->mountUsing(function (Schema $form, PurchaseOrder $record) {
                $record->load('items.product');

                $receivedQuantities = GoodsReceiptItem::query()
                    ->whereIn('purchase_order_item_id', $record->items->pluck('id'))
                    ->selectRaw('purchase_order_item_id, SUM(quantity_received) as total_received')
                    ->groupBy('purchase_order_item_id')
                    ->pluck('total_received', 'purchase_order_item_id');

                $form->fill([
                    'items' => $record->items->map(function ($item) use ($receivedQuantities) {
                        $total_received = $receivedQuantities->get($item->id, 0);

                        return [
                            'purchase_order_item_id' => $item->id,
                            'product_name' => $item->product->name,
                            'quantity_promised' => $item->quantity,
                            'total_quantity_received' => $total_received,
                            'quantity_received' => max(0, $item->quantity - $total_received),
                        ];
                    }),
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
                            ->required(function (Get $get): bool {
                                $promised = (float) $get('quantity_promised');
                                $alreadyReceived = (float) $get('total_quantity_received');

                                return ($promised - $alreadyReceived) > 0;
                            })
                            ->disabled(function (Get $get): bool {
                                $promised = (float) $get('quantity_promised');
                                $alreadyReceived = (float) $get('total_quantity_received');

                                return ($promised - $alreadyReceived) <= 0;
                            }),
                        TextInput::make('quantity_promised')
                            ->label('Quantity Promised')
                            ->numeric()
                            ->disabled(),
                        TextInput::make('total_quantity_received')
                            ->label('Total Quantity Received')
                            ->numeric()
                            ->disabled(),
                        TextInput::make('quantity_received')
                            ->label('Quantity Received')
                            ->numeric()
                            ->required()
                            ->disabled(function (Get $get): bool {
                                $promised = (float) $get('quantity_promised');
                                $alreadyReceived = (float) $get('total_quantity_received');

                                return ($promised - $alreadyReceived) <= 0;
                            }),
                    ])
                    ->columns(5),
                Textarea::make('remarks'),
            ])
            ->action(function (PurchaseOrder $record, array $data) {
                DB::transaction(function () use ($record, $data) {
                    $goodsReceipt = GoodsReceipt::create([
                        'purchase_order_id' => $record->id,
                        'received_date' => now(),
                        'received_by' => auth()->id(),
                        'remarks' => $data['remarks'] ?? null,
                    ]);

                    foreach ($data['items'] as $itemData) {
                        if ($itemData['quantity_received'] ?? null) {
                            $goodsReceipt->items()->create([
                                'purchase_order_item_id' => $itemData['purchase_order_item_id'],
                                'warehouse_location_id' => $itemData['warehouse_location_id'],
                                'quantity_received' => $itemData['quantity_received'],
                            ]);
                        }
                    }

                    $record->syncReceivingStatus();
                });
            });
    }
}
