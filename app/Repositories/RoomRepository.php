<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    public function all()
    {
        return Room::query()->with('hotel')->get();
    }

    public function find($id)
    {
        return Room::query()->findOrFail($id);
    }

    public function findByHotelId($id, $page = 10)
    {
        return Room::query()->where('hotel_id', $id)->orderByDesc('reservation_status')->paginate($page);
    }

    public function create(array $data)
    {
        return Room::query()->create($data);
    }

    public function update(array $data, $id)
    {
        $room = Room::query()->findOrFail($id);
        $room->update($data);
        return $room;
    }

    public function delete($id)
    {
        $room = Room::query()->findOrFail($id);
        $room->delete();
        return $room;
    }
}
