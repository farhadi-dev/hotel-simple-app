<?php

namespace App\Services;

use App\DTO\CreateRoomDTO;
use App\Repositories\RoomRepository;

class RoomService
{
    protected $room;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->room = $roomRepository;
    }
    public function getAllRooms()
    {
        return $this->room->all();
    }
    public function getRoomById($id)
    {
        return $this->room->find($id);
    }
    public function getRoomsByHotelId($id, $page)
    {
        return $this->room->findByHotelId($id, $page);
    }
    public function createRoom(CreateRoomDTO $createRoomDTO)
    {
        return $this->room->create([
            'room_number' => $createRoomDTO->room_number,
            'room_type' => $createRoomDTO->room_type,
            'floor_number' => $createRoomDTO->floor_number,
            'hotel_id' => $createRoomDTO->hotel_id,
            'reservation_status'=> $createRoomDTO->reservation_status,
        ]);
    }
    public function updateRoom($data, $id)
    {
        return $this->room->update($data, $id);
    }
    public function deleteRoom($id)
    {
        return $this->room->delete($id);
    }
}
