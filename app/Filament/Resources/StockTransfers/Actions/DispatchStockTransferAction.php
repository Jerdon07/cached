<?php

namespace App\Filament\Resources\StockTransfers\Actions;

use App\Actions\DispatchStockTransfer;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockTransfer;
use App\Models\WarehouseLocation;
use App\StockTransferStatus;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;

class DispatchStockTransferAction
{
    public static function make(): Action
    {
        return Action::make('dispatch')
            ->icon(Heroicon::ArrowsRightLeft)
            ->visible(fn (StockTransfer $record): bool => auth()->user()->can('dispatch', $record))
            ->fillForm(fn (StockTransfer $record): array => [
                'items' => $record->items()->with('product')->get()->map(fn ($item) => [
                    'id' => $item->id,
                    'product' => $item->product->name,
                    'requested' => $item->quantity,
                    'picks' => [[]],
                ])->all(),
            ])
            ->schema([
                Repeater::make('items')
                    ->addable(false)->deletable(false)->reorderable(false)
                    ->schema([
                        Hidden::make('id'),
                        TextInput::make('product')->disabled()->dehydrated(false),
                        TextInput::make('requested')->disabled()->dehydrated(false),
                        Repeater::make('picks')
                            ->minItems(1)
                            ->schema([
                                Select::make('warehouse_location_id')
                                    ->label('Location')
                                    ->required()
                                    ->options(fn (StockTransfer $record) => WarehouseLocation::query()
                                        ->where('warehouse_id', $record->from_warehouse_id)
                                        ->get()
                                        ->pluck('full_location', 'id')),
                                TextInput::make('quantity')->numeric()->required()->minValue(0.001),
                            ]),
                    ]),
            ])
            ->action(function (StockTransfer $record, array $data): void {
                app(DispatchStockTransfer::class)->handle($record, $data['items'], auth()->user());
            });
    }
}