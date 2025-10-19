<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('logout',[AuthController::class, 'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Hotel API Documentation",
 *      description="API documentation for the hotel app"
 * )
 */

Route::prefix('hotel')->group(function () {
    Route::post('/create', [HotelController::class, 'createHotel']);
    Route::put('/{id}', [HotelController::class, 'updateHotel']);
    Route::delete('/{id}', [HotelController::class, 'deleteHotel']);
});
Route::get('hotels/all', [HotelController::class, 'show']);
Route::get('hotels/{id}', [HotelController::class, 'getHotelById']);

Route::prefix('rooms')->group(function () {
    Route::get('/hotel/{id}', [RoomController::class, 'getRoomsByHotelId']);
    Route::post('/', [RoomController::class, 'create']);
    Route::put('/{id}', [RoomController::class, 'update']);
    Route::delete('/{id}', [RoomController::class, 'delete']);
});
Route::get('/', [RoomController::class, 'getAllRooms']);
Route::get('/{id}', [RoomController::class, 'getRoomById']);



Route::prefix('reserve')->group(function () {
    Route::get('/all', [ReservationController::class, 'allReservations']);
    Route::get('/user/{id}', [ReservationController::class, 'findByUserId']);
    Route::get('/room/{id}', [ReservationController::class, 'findByRoom']);
    Route::post('/', [ReservationController::class, 'createReservation']);
    Route::put('/{id}', [ReservationController::class, 'updateReservation']);
    Route::delete('/{id}', [ReservationController::class, 'deleteReservation']);
});
Route::get('/{id}', [ReservationController::class, 'findReservationById']);

