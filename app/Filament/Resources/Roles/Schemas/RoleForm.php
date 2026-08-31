<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                Textarea::make('description'),
                Select::make('permissions')
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => Str::headline($record->name))
                    ->relationship('permissions', 'name')
                    ->columnSpanFull()
                    ->multiple()
            ]);
    }
}
