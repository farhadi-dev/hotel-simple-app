<?php

namespace App\DTO;

class CreateReservationDTO
{
    public $room_id;
    public $user_id;
    public $check_in;
    public $check_out;

    public static function fromRequest(array $data): CreateReservationDTO
    {
        $reservationDto = new self();
        $reservationDto->room_id = $data['room_id'];
        $reservationDto->user_id = $data['user_id'];
        $reservationDto->check_in = $data['check_in'];
        $reservationDto->check_out = $data['check_out'];
        return $reservationDto;
    }
}
