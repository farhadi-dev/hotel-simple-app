<?php

namespace App\DTO;

class CreateRoomDTO
{
    public $room_type;
    public $room_number;
    public $floor_number;
    public $hotel_id;
    public $reservation_status;

    public static function fromRequest(array $data): CreateRoomDTO
    {
        $room = new self();
        $room->room_type = $data['room_type'];
        $room->room_number = $data['room_number'];
        $room->floor_number = $data['floor_number'];
        $room->hotel_id = $data['hotel_id'];
        $room->reservation_status = $data['reservation_status'];
        return $room;
    }

}
