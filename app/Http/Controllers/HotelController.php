<?php

namespace App\Http\Controllers;

use App\DTO\CreateHotelDTO;
use App\Http\Requests\CreateHotelRequest;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Hotels",
 *     description="API Endpoints for Hotels"
 * )
 */
class HotelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hotels",
     *     tags={"Hotels"},
     *     summary="Get list of hotels",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index(HotelService $hotelService)
    {
        $hotels = $hotelService->getAllHotels();

        return HotelResource::collection($hotels);
    }
    /**
     * @OA\Get(
     *     path="/api/hotels/{id}",
     *     tags={"Hotels"},
     *     summary="Get Hotels By Id",
     *     @OA\Parameter (
     *         name="id",
     *         required=true,
     *         in="path",
     *         description="Id for hotel",
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number for pagination (default is 1)",
     *         @OA\Schema(type="integer", default=1)
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function show(Request $request, HotelService $hotelService, $id)
    {
        $page = $request->query('page', 1);
        $perPage = 6;
        $hotel = $hotelService->getById($id, $perPage, $page);
        return response()->json($hotel);
    }

    public function createHotel(HotelService $hotelService, CreateHotelRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotels', 'public');
            $data['image'] = $imagePath;
        }
        $hotel = $hotelService->createHotel(CreateHotelDTO::fromRequest($data));
        return response()->json($hotel, 201);
    }

    public function updateHotel(HotelService $hotelService, Request $request, $id)
    {
        $hotel = $hotelService->updateHotel($id);
        $hotel->update($request->all());
        return response()->json($hotel, 200);
    }

    public function deleteHotel(HotelService $hotelService, $id)
    {
        $hotel = $hotelService->getById($id);
        $hotel->delete();
        return response()->json(null, 204);
    }
}
