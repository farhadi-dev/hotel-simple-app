<?php

namespace App\Services;

use App\DTO\CreateHotelDTO;
use App\Repositories\HotelRepository;

class HotelService
{
    protected $hotel;
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotel = $hotelRepository;
    }

    public function getAllHotels()
    {
        return $this->hotel->all();
    }
    public function getById($id, $perPage = 6, $page = 1)
    {
        return $this->hotel->find($id, $perPage, $page);
    }
    public function createHotel(CreateHotelDTO $hotelDTO)
    {
       return $this->hotel->create([
            'name' => $hotelDTO->name,
            'address' => $hotelDTO->address,
           'image' => $hotelDTO->image,
        ]);
    }
    public function updateHotel(array $data, $id)
    {
        return $this->hotel->update($data, $id);
    }
    public function deleteHotel($id)
    {
        return $this->hotel->delete($id);
    }

}
