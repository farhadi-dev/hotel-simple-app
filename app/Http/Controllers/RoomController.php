<?php

namespace App\Http\Controllers;

use App\DTO\CreateRoomDTO;
use App\DTO\UpdateRoomDTO;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomController extends Controller
{
    public function index(RoomService $roomService): AnonymousResourceCollection
    {
        $rooms = $roomService->getAll();
        return RoomResource::collection($rooms);
    }

    public function show(RoomService $roomService, $id): RoomResource
    {
        $room = $roomService->getById($id);
        return new RoomResource($room);
    }

    public function byHotel(RoomService $roomService, $id, $page): AnonymousResourceCollection
    {
        $rooms = $roomService->getByHotelId($id, $page);
        return RoomResource::collection($rooms);
    }

    public function store(RoomService $roomService, CreateRoomRequest $request): RoomResource
    {
        $data = $request->validated();
        $room = $roomService->create(CreateRoomDTO::fromRequest($data));
        return new RoomResource($room);
    }

    public function update($id, RoomService $roomService, UpdateRoomRequest $request): RoomResource
    {
        $data = $request->validated();
        $room = $roomService->update($id, UpdateRoomDTO::fromRequest($data));
        return new RoomResource($room);
    }

    public function destroy($id, RoomService $roomService): JsonResponse
    {
        $roomService->delete($id);
        return response()->json(['message' => 'Room deleted successfully.'], 200);
    }
}
