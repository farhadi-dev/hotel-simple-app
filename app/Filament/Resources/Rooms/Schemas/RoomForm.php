<?php

namespace App\Filament\Resources\Rooms\Schemas;

use App\Models\Hotel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('room_type')
                    ->required(),
                TextInput::make('room_number')
                    ->required(),
                TextInput::make('floor_number')
                    ->required(),
                Select::make('hotel_id')
                    ->label('Hotel')
                    ->options(Hotel::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Toggle::make('reservation_status')
                    ->required(),
            ]);
    }
}
