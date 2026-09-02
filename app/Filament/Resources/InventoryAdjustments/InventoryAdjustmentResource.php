<?php

namespace App\Filament\Resources\InventoryAdjustments;

use App\Filament\Resources\InventoryAdjustments\Pages\CreateInventoryAdjustment;
use App\Filament\Resources\InventoryAdjustments\Pages\EditInventoryAdjustment;
use App\Filament\Resources\InventoryAdjustments\Pages\ListInventoryAdjustments;
use App\Filament\Resources\InventoryAdjustments\Pages\ViewInventoryAdjustment;
use App\Filament\Resources\InventoryAdjustments\Schemas\InventoryAdjustmentForm;
use App\Filament\Resources\InventoryAdjustments\Schemas\InventoryAdjustmentInfolist;
use App\Filament\Resources\InventoryAdjustments\Tables\InventoryAdjustmentsTable;
use App\Models\InventoryAdjustment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InventoryAdjustmentResource extends Resource
{
    protected static ?string $model = InventoryAdjustment::class;

    protected static string|UnitEnum|null $navigationGroup = 'Warehousing';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;

    public static function form(Schema $schema): Schema
    {
        return InventoryAdjustmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InventoryAdjustmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventoryAdjustmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInventoryAdjustments::route('/'),
            'create' => CreateInventoryAdjustment::route('/create'),
            'view' => ViewInventoryAdjustment::route('/{record}'),
            'edit' => EditInventoryAdjustment::route('/{record}/edit'),
        ];
    }
}
