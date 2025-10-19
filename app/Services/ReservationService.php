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

    public function getAllReservations()
    {
        return $this->reservation->all();
    }
    public function getReservationById($id)
    {
        return $this->reservation->find($id);
    }
    public function getReservationByUser($userId)
    {
        return $this->reservation->findByUser($userId)->load('room.hotel');
    }
    public function getReservationByRoom($roomId)
    {
        return $this->reservation->findByRoom($roomId);
    }
    public function createReservation($data)
    {
        return $this->reservation->create($data);
    }
    public function updateReservation($id, $data)
    {
        return $this->reservation->update($id, $data);
    }
    public function deleteReservation($id)
    {
        return $this->reservation->delete($id);
    }
}
