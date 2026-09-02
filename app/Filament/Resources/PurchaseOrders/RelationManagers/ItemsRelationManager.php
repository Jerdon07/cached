<?php

namespace App\Filament\Resources\PurchaseOrders\RelationManagers;

use App\Models\Product;
use App\Models\ProductSupplier;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if (! $state) {
                            return;
                        }

                        $supplier_id = $this->getOwnerRecord()->supplier_id;

                        $unit_cost = ProductSupplier::where('supplier_id', $supplier_id)
                            ->where('product_id', $state)
                            ->valueOrFail('cost_price');

                        $set('unit_cost', $unit_cost);
                    }),
                TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->suffix(function (Get $get): ?string {
                        $product_id = $get('product_id');
                        if (! $product_id) {
                            return null;
                        }

                        return Product::findOrFail($product_id)->unit->abbreviation;
                    }),
                TextInput::make('unit_cost')
                    ->numeric()
                    ->required()
                    ->prefix('₱'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Items')
            ->columns([
                TextColumn::make('product.name')
                    ->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('unit_cost')
                    ->prefix('₱'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
