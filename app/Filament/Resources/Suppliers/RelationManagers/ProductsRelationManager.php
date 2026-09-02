<?php

namespace App\Filament\Resources\Suppliers\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('supplier_sku')
                    ->maxLength(255),

                TextInput::make('cost_price')
                    ->required()
                    ->numeric()
                    ->minValue(0),

                Toggle::make('preferred')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),

                TextColumn::make('pivot.supplier_sku')
                    ->label('Supplier SKU'),

                TextColumn::make('pivot.cost_price')
                    ->label('Cost Price')
                    ->money('USD'),

                IconColumn::make('pivot.preferred')
                    ->label('Preferably')
                    ->boolean(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->schema(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        TextInput::make('supplier_sku')
                            ->maxLength(255),
                        TextInput::make('cost_price')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Toggle::make('preferred')
                            ->default(false),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                DetachBulkAction::make(),
            ]);
    }
}
