<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use App\Models\Product;
use App\Models\Supplier;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplier_id')
                    ->relationship('supplier', 'company_name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(
                        fn (Get $get, Set $set) => static::updateUnitCost($get, $set),
                    ),
                DatePicker::make('expected_delivery_date')
                    ->hidden(),
                Repeater::make('items')
                    ->relationship('items')
                    ->hiddenOn('edit')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        Select::make('product_id')
                            ->relationship(
                                'product',
                                'name',
                                function (Get $get, Builder $query) {
                                    $supplier_id = $get('../../supplier_id');

                                    if (! $supplier_id) {
                                        return $query->whereRaw('1 = 0');
                                    }

                                    return $query->whereIn('products.id', function ($subQuery) use ($supplier_id) {
                                        $subQuery->select('product_id')
                                            ->from('product_suppliers')
                                            ->where('supplier_id', $supplier_id);
                                    });
                                }
                            )
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) => static::updateUnitCost($get, $set),
                            ),
                        TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->disabled(fn (Get $get) => ! $get('product_id'))
                            ->suffix(function (Get $get): ?string {
                                $productId = $get('product_id');

                                if (! $productId) {
                                    return null;
                                }

                                return Product::find($productId)?->unit?->abbreviation;
                            }),
                        TextInput::make('unit_cost')
                            ->numeric()
                            ->required()
                            ->default(function (Get $get): ?int {
                                $supplier_id = $get('../../supplier_id');
                                $product_id = $get('product_id');

                                if (! $supplier_id || ! $product_id) {
                                    return null;
                                }

                                return Supplier::find($supplier_id)->products()->find($product_id)->pivot->cost_price;
                            })
                            ->prefix('₱'),
                    ]),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function updateUnitCost(Get $get, Set $set)
    {
        $supplier_id = $get('../../supplier_id');
        $product_id = $get('product_id');

        if (! $supplier_id || ! $product_id) {
            $set('unit_cost', null);

            return;
        }

        $unit_cost = DB::table('product_suppliers')
            ->where('supplier_id', $supplier_id)
            ->where('product_id', $product_id)
            ->value('cost_price');

        $set('unit_cost', $unit_cost);
    }
}
