<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelDTO
{
public $name;
public $address;
public $image;

public static function fromRequest(array $data): CreateHotelDTO
{
    $hotel = new self();
    $hotel->name = $data['name'];
    $hotel->address = $data['address'];
    $hotel->image = $data['image'];
    return $hotel;
}
}
