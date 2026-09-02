<?php

namespace App\Filament\Resources\InventoryAdjustments\Schemas;

use App\InventoryAdjustmentStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class InventoryAdjustmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('reason')
                    ->formatStateUsing(fn ($state): string => Str::headline($state->value))
                    ->tooltip(fn ($record) => $record->reason->label()),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('createdBy.name')
                    ->hidden(fn ($record) => $record->status === InventoryAdjustmentStatus::Draft)
                    ->label('Created By'),
                TextEntry::make('approvedBy.name')
                    ->hidden(fn ($record) => in_array($record->status, [InventoryAdjustmentStatus::Draft, InventoryAdjustmentStatus::Pending]))
                    ->label('Approved By'),
                TextEntry::make('approved_at')
                    ->hidden(fn ($record) => in_array($record->status, [InventoryAdjustmentStatus::Draft, InventoryAdjustmentStatus::Pending]))
                    ->date()
                    ->dateTimeTooltip(),
                TextEntry::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
