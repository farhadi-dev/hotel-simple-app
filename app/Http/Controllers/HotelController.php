<?php

namespace App\Http\Controllers;

use App\DTO\CreateHotelDTO;
use App\DTO\UpdateHotelDTO;
use App\Http\Requests\CreateHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
    public function index(HotelService $hotelService): AnonymousResourceCollection
    {
        $hotels = $hotelService->getAll();

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
    public function show(HotelService $hotelService, $id): HotelResource
    {
        $hotel = $hotelService->getById($id);
        return new HotelResource($hotel);
    }

    public function store(HotelService $hotelService, CreateHotelRequest $request): HotelResource
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotels', 'public');
            $data['image'] = $imagePath;
        }
        $hotel = $hotelService->create(CreateHotelDTO::fromRequest($data));
        return new HotelResource($hotel);
    }

    public function update(HotelService $hotelService, UpdateHotelRequest $request, $id):AnonymousResourceCollection
    {
        $data = $request->validated();
        $hotel = $hotelService->update($id, UpdateHotelDTO::fromRequest($data));
        return HotelResource::collection($hotel);
    }

    public function destroy(HotelService $hotelService, $id): JsonResponse
    {
        $hotelService->delete($id);
        return response()->json(['message' => 'Room deleted successfully.'], 200);
    }
}
