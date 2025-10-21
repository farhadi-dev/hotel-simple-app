<?php

namespace App\Repositories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository extends BaseRepository
{
    public function __construct(Reservation $model)
    {
        parent::__construct($model);
    }

    public function findByUser($userId): Collection
    {
        return Reservation::query()->where('user_id', $userId)->with('room.hotel')->get();
    }

    public function findByRoom($roomId): Collection
    {
        return Reservation::query()->where('room_id', $roomId)->with('room.hotel')->get();
    }
}
