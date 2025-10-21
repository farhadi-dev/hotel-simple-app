<?php

namespace App\Services;

use App\DTO\CreateRoomDTO;
use App\DTO\UpdateRoomDTO;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomService
{
    protected $room;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->room = $roomRepository;
    }
    public function getAll(): EloquentCollection
    {
        return $this->room->getAll();
    }
    public function getById($id): EloquentCollection
    {
        return $this->room->getById($id);
    }
    public function getByHotelId($id, $page): LengthAwarePaginator
    {
        return $this->room->getByHotelId($id, $page);
    }
    public function create(CreateRoomDTO $createRoomDTO): Model
    {
        return $this->room->create([
            'room_number' => $createRoomDTO->room_number,
            'room_type' => $createRoomDTO->room_type,
            'floor_number' => $createRoomDTO->floor_number,
            'hotel_id' => $createRoomDTO->hotel_id,
            'reservation_status'=> $createRoomDTO->reservation_status,
        ]);
    }
    public function update($id, UpdateRoomDTO $roomDTO): Model
    {
        return $this->room->update($id, [
            'room_number' => $roomDTO->room_number,
            'room_type' => $roomDTO->room_type,
            'floor_number' => $roomDTO->floor_number,
            'hotel_id' => $roomDTO->hotel_id,
            'reservation_status'=> $roomDTO->reservation_status,
        ]);
    }
    public function delete($id): Model
    {
        return $this->room->delete($id);
    }
}
