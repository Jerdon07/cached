<?php

namespace App\Filament\Resources\GoodsReceipts\Schemas;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GoodsReceiptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('purchase_order_id')
                    ->relationship('purchaseOrder', 'id')
                    ->default(fn () => request()->query('purchase_order'))
                    ->disabled()
                    ->relationship('purchaseOrder.supplier', 'company_name')
                    ->required()
                ->label('Supplying Company'),
                DatePicker::make('received_date')
                    ->required()
                    ->default(now()),
                Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        Select::make('purchase_order_item_id')
                            ->options(function () {
                                $id = request()->query('purchase_order');
                                return PurchaseOrderItem::where('purchase_order_id', $id)
                                    ->with('product')
                                    ->get()
                                    ->pluck('product.name', 'id');
                            }),
                    ]),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}
