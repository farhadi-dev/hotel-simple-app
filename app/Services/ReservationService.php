<?php

namespace App\Services;

use App\DTO\CreateReservationDTO;
use App\DTO\UpdateReservationDTO;
use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ReservationService
{
    protected $reservation;
    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservation = $reservationRepository;
    }

    public function getAll(): Collection
    {
        return $this->reservation->getAll();
    }
    public function getById($id): Collection
    {
        return $this->reservation->getById($id);
    }
    public function getByUser($userId): Collection
    {
        return $this->reservation->findByUser($userId)->load('room.hotel');
    }
    public function getByRoom($roomId): Collection
    {
        return $this->reservation->findByRoom($roomId);
    }
    public function create(CreateReservationDTO $createReservationDTO): Model
    {
        return $this->reservation->create([
            'user_id'=>$createReservationDTO->user_id,
            'room_id'=>$createReservationDTO->room_id,
            'check_in'=>$createReservationDTO->check_in,
            'check_out'=>$createReservationDTO->check_out,
        ]);
    }
    public function update($id, UpdateReservationDTO $updateReservationDTO): Model
    {
        return $this->reservation->update($id, [
            'user_id'=>$updateReservationDTO->user_id,
            'room_id'=>$updateReservationDTO->room_id,
            'check_in'=>$updateReservationDTO->check_in,
            'check_out'=>$updateReservationDTO->check_out,
        ]);
    }
    public function delete($id): Model
    {
        return $this->reservation->delete($id);
    }
}
