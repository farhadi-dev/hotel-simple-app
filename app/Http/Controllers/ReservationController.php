<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function allReservations(ReservationService $reservationService)
    {
        $reservations = $reservationService->getAllReservations();
        return response()->json($reservations);
    }

    public function findReservationById(ReservationService $reservationService, $id)
    {
        $reservation = $reservationService->getReservationById($id);
        return response()->json($reservation);
    }

    public function findByUserId(ReservationService $reservationService, $id)
    {
        $reservation = $reservationService->getReservationByUser($id);
        return response()->json($reservation);
    }

    public function findByRoom(ReservationService $reservationService, $id)
    {
        $reservation = $reservationService->getReservationByRoom($id);
        return response()->json($reservation);
    }

    public function createReservation(Request $request, ReservationService $reservationService)
    {
        $reservation = $reservationService->createReservation($request->all());
        return response()->json($reservation, 201);
    }

    public function updateReservation(Request $request, ReservationService $reservationService, $id)
    {
        $reservation = $reservationService->updateReservation($request->all(), $id);
        return response()->json($reservation, 200);
    }
    public function deleteReservation(ReservationService $reservationService, $id)
    {
        $reservation = $reservationService->deleteReservation($id);
        return response()->json($reservation, 200);
    }
}
