<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Models\Room;

class ReservationRepository
{
    public function all()
    {
        return Reservation::query()->with(['user', 'room.hotel'])->get();
    }

    public function find($id)
    {
        return Reservation::query()->findOrFail($id);
    }

    public function findByUser($userId)
    {
        return Reservation::query()->where('user_id', $userId)->with('room.hotel')->get();
    }

    public function findByRoom($roomId)
    {
        return Reservation::query()->where('room_id', $roomId)->get();
    }

    public function create(array $data)
    {
        if (!isset($data['date'])) {
            $data['date'] = now()->toDateString(); // auto-set today
        }
        return Reservation::query()->create($data);
    }

    public function update(array $data, $id)
    {
        $reservation = Reservation::query()->findOrFail($id);
        $reservation->update($data);
        return $reservation;
    }

    public function delete($id)
    {
        $reservation = Reservation::query()->findOrFail($id);
        $reservation->delete();
        return $reservation;
    }
}
