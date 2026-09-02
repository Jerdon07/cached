<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->maxLength('255')
                    ->unique()
                    ->helperText('Enter company name'),
                TextInput::make('contact_person')
                    ->maxLength('255')
                    ->helperText('Enter name of contact person'),
                TextInput::make('phone')
                    ->length('11')
                    ->unique()
                    ->helperText('Enter phone number'),
                TextInput::make('email')
                    ->maxLength('100')
                    ->unique()
                    ->helperText('Enter email address'),
                TextInput::make('address')
                    ->maxLength('255')
                    ->helperText('Enter company address'),
                TextInput::make('city')
                    ->maxLength('255')
                    ->helperText('Enter city location'),
                TextInput::make('province')
                    ->maxLength('255')
                    ->helperText('Enter province location'),
                TextInput::make('postal_code')
                    ->maxLength('255')
                    ->numeric()
                    ->helperText('Enter postal code'),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}
