<?php

namespace App\Services;

use App\DTO\CreateHotelDTO;
use App\DTO\UpdateHotelDTO;
use App\Repositories\HotelRepository;
use Illuminate\Database\Eloquent\Collection as Collection;
use Illuminate\Database\Eloquent\Model as Model;

class HotelService
{
    protected $hotel;
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotel = $hotelRepository;
    }

    public function getAll(): Collection
    {
        return $this->hotel->getAll();
    }
    public function getById($id): Collection
    {
        return $this->hotel->getById($id);
    }
    public function create(CreateHotelDTO $hotelDTO): Model
    {
        return $this->hotel->create([
            'name' => $hotelDTO->name,
            'address' => $hotelDTO->address,
            'image' => $hotelDTO->image,
        ]);
    }
    public function update($id, UpdateHotelDTO $hotelDTO): Model
    {
        return $this->hotel->update($id, [
            'name' => $hotelDTO->name,
            'address' => $hotelDTO->address,
            'image' => $hotelDTO->image,
        ]);
    }
    public function delete($id): Model
    {
        return $this->hotel->delete($id);
    }

}
