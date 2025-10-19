<?php
namespace App\Repositories;

use App\Models\Hotel;

class HotelRepository{

    public function all(){
        return Hotel::query()->with('rooms')->get();
    }
    public function find($id, $perPage = 6, $page = 1)
    {
        // Fetch hotel
        $hotel = Hotel::findOrFail($id);

        // Paginate rooms, available rooms first
        $rooms = $hotel->rooms()
            ->orderByDesc('reservation_status') // available first
            ->paginate($perPage, ['*'], 'page', $page);

        return [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'address' => $hotel->address,
            'image' => $hotel->image,
            'rooms' => $rooms->items(),
            'meta' => [
                'current_page' => $rooms->currentPage(),
                'last_page' => $rooms->lastPage(),
                'per_page' => $rooms->perPage(),
                'total' => $rooms->total(),
            ],
        ];
    }

    public function create(array $data)
    {
        return Hotel::query()->create($data);
    }
    public function update(array $data, $id)
    {
        $hotel = Hotel::query()->findOrFail($id);
        $hotel->update($data);
        return $hotel;
    }
    public function delete($id)
    {
        $hotel = Hotel::query()->findOrFail($id);
        $hotel->delete();
        return $hotel;
    }
}
