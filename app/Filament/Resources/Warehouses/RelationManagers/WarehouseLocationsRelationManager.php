<?php

namespace App\Filament\Resources\Warehouses\RelationManagers;

use App\Models\StockMovement;
use App\Models\WarehouseLocation;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarehouseLocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'WarehouseLocations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('zone'),
                TextInput::make('aisle'),
                TextInput::make('rack'),
                TextInput::make('shelf'),
                TextInput::make('bin'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('description')
                    ->columnSpanFull()
                    ->hiddenLabel()
                    ->weight(FontWeight::SemiBold)
                    ->placeholder('-'),
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Details')
                            ->columns(5)
                            ->schema([
                                TextEntry::make('zone')
                                    ->placeholder('-'),
                                TextEntry::make('aisle')
                                    ->placeholder('-'),
                                TextEntry::make('rack')
                                    ->placeholder('-'),
                                TextEntry::make('shelf')
                                    ->placeholder('-'),
                                TextEntry::make('bin')
                                    ->placeholder('-'),
                            ]),
                        Tab::make('Items')
                            ->schema([
                                RepeatableEntry::make('stockedProducts')
                                    ->hiddenLabel()
                                    ->state(fn (WarehouseLocation $record) => StockMovement::query()
                                        ->selectRaw('product_id, SUM(quantity) as quantity')
                                        ->where('warehouse_location_id', $record->id)
                                        ->groupBy('product_id')
                                        ->havingRaw('SUM(quantity) > 0')
                                        ->with('product.unit')
                                        ->get())
                                    ->schema([
                                        TextEntry::make('product.name')
                                            ->label('Product Name'),
                                        TextEntry::make('quantity')
                                            ->label('Available Quantity')
                                            ->suffix(fn ($record) => $record->product->unit->abbreviation),
                                    ]),
                            ]),
                    ]),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (WarehouseLocation $record): bool => $record->trashed()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('zone')
            ->columns([
                TextColumn::make('zone')
                    ->searchable(),
                TextColumn::make('aisle')
                    ->searchable(),
                TextColumn::make('rack')
                    ->searchable(),
                TextColumn::make('shelf')
                    ->searchable(),
                TextColumn::make('bin')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
