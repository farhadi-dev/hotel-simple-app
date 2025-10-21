<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomRepository extends BaseRepository
{
    public function __construct(Room $model)
    {
        parent::__construct($model);
    }

    public function getByHotelId(int $hotelId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where('hotel_id', $hotelId)
            ->orderByDesc('reservation_status')
            ->paginate($perPage);
    }
}
