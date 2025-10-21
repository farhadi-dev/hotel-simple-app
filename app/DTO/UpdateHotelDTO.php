<?php

namespace App\DTO;

use App\Http\Requests\UpdateHotelRequest;

class UpdateHotelDTO
{
    public $name;
    public $address;
    public $image;

    public static function fromRequest(array $data): UpdateHotelDTO
    {
        $hotelDTO = new self();
        $hotelDTO->name = $data['name'];
        $hotelDTO->address = $data['address'];
        $hotelDTO->image = $data['image'];
        return $hotelDTO;
    }
}
