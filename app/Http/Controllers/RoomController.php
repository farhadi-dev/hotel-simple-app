<?php

namespace App\Http\Controllers;

use App\DTO\CreateRoomDTO;
use App\Http\Requests\CreateRoomRequest;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getAllRooms(RoomService $roomService)
    {
        $rooms = $roomService->getAllRooms();
        return response()->json($rooms);
    }
    public function getRoomById(RoomService $roomService, $id)
    {
        $room = $roomService->getRoomById($id);
        return response()->json($room);
    }
    public function getRoomsByHotelId(RoomService $roomService, $id, $page)
    {
        $rooms = $roomService->getRoomsByHotelId($id, $page);
        return response()->json($rooms);
    }
    public function create(RoomService $roomService, CreateRoomRequest $request)
    {
        $data = $request->validated();
        $room = $roomService->createRoom(CreateRoomDTO::fromRequest($data));
        return response()->json($room, 201);
    }
    public function update($id, RoomService $roomService, Request $request)
    {
        $room = $roomService->updateRoom($id, $request->all());
        return response()->json($room, 200);
    }
    public function delete($id, RoomService $roomService)
    {
        $room = $roomService->deleteRoom($id);
        return response()->json($room, 200);
    }
}
