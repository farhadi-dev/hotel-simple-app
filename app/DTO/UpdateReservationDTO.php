<?php

namespace App\DTO;

class UpdateReservationDTO
{
    public $room_id;
    public $user_id;
    public $check_in;
    public $check_out;

    public static function fromRequest(array $data): UpdateReservationDTO
    {
        $reservationDTO = new self();
        $reservationDTO->room_id = $data['room_id'];
        $reservationDTO->user_id = $data['user_id'];
        $reservationDTO->check_in = $data['check_in'];
        $reservationDTO->check_out = $data['check_out'];
        return $reservationDTO;
    }
}
