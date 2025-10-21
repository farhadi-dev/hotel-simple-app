<?php

namespace App\Http\Controllers;

use App\DTO\CreateReservationDTO;
use App\DTO\UpdateReservationDTO;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservation;
use App\Http\Resources\ReservationResource;
use App\Repositories\ReservationRepository;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationController extends Controller
{
    public function index(ReservationService $reservationService): AnonymousResourceCollection
    {
        $reservations = $reservationService->getAll();
        return ReservationResource::collection($reservations);
    }

    public function show(ReservationService $reservationService, $id): ReservationResource
    {
        $reservation = $reservationService->getById($id);
        return new ReservationResource($reservation);
    }

    public function byUser(ReservationService $reservationService, $id): ReservationResource
    {
        $reservation = $reservationService->getByUser($id);
        return new ReservationResource($reservation);
    }

    public function byRoom(ReservationService $reservationService, $id): ReservationResource
    {
        $reservation = $reservationService->getByRoom($id);
        return new ReservationResource($reservation);
    }

    public function store(CreateReservationRequest $request, ReservationService $reservationService): AnonymousResourceCollection
    {
        $data = $request->validated();
        $reservation = $reservationService->create(CreateReservationDTO::fromRequest($data));
        return ReservationResource::collection($reservation);
    }

    public function update($id, UpdateReservation $request, ReservationService $reservationService): AnonymousResourceCollection
    {
        $data = $request->validated();
        $reservation = $reservationService->update($id, UpdateReservationDTO::fromRequest($data));
        return ReservationResource::collection($reservation);
    }

    public function destroy(ReservationService $reservationService, $id): JsonResponse
    {
        $reservationService->delete($id);
        return response()->json(['message' => 'Room deleted successfully.'], 200);
    }
}
