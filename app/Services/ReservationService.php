<?php

namespace App\Services;

use App\Models\Reservation;
use App\Repositories\ReservationRepository;

class ReservationService
{
    protected $reservation;
    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservation = $reservationRepository;
    }

    public function getAll()
    {
        return $this->reservation->getAll();
    }
    public function getById($id)
    {
        return $this->reservation->getById($id);
    }
    public function getByUser($userId)
    {
        return $this->reservation->findByUser($userId)->load('room.hotel');
    }
    public function getByRoom($roomId)
    {
        return $this->reservation->findByRoom($roomId);
    }
    public function create($data)
    {
        return $this->reservation->create($data);
    }
    public function update($id, $data)
    {
        return $this->reservation->update($id, $data);
    }
    public function delete($id)
    {
        return $this->reservation->delete($id);
    }
}
