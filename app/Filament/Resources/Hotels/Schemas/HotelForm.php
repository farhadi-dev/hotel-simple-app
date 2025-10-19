<?php

namespace App\Filament\Resources\Hotels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HotelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                Toggle::make('availibility_status')
                    ->required(),
            ]);
    }
}
