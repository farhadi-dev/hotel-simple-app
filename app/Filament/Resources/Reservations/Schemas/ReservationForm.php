<?php

namespace App\Filament\Resources\Reservations\Schemas;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('User')
                    ->options(User::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('room_id')
                    ->label('Room')
                    ->options(Room::pluck('room_number', 'id'))
                    ->searchable()
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                Toggle::make('status')
                    ->default(true)
                    ->required(),
            ]);
    }
}
