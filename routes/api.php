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

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::prefix('hotels')->group(function () {
    Route::get('', [HotelController::class, 'show']);
    Route::post('', [HotelController::class, 'createHotel']);
    Route::get('{id}', [HotelController::class, 'getHotelById']);
    Route::put('{id}', [HotelController::class, 'updateHotel']);
    Route::delete('{id}', [HotelController::class, 'deleteHotel']);
    Route::get('{id}/rooms', [RoomController::class, 'getRoomsByHotelId']);
});

Route::prefix('rooms')->group(function () {
    Route::get('', [RoomController::class, 'getAllRooms']);
    Route::post('', [RoomController::class, 'create']);
    Route::get('{id}', [RoomController::class, 'getRoomById']);
    Route::put('{id}', [RoomController::class, 'update']);
    Route::delete('{id}', [RoomController::class, 'delete']);
});

// Get user's reservations: /users/{id}/reservations
// Get Logged-in user's reservations: /users/reservations


Route::prefix('reserves')->group(function () {
    Route::get('', [ReservationController::class, 'allReservations']);
    Route::get('/user/{id}', [ReservationController::class, 'findByUserId']);
    Route::get('/room/{id}', [ReservationController::class, 'findByRoom']);
    Route::post('/', [ReservationController::class, 'createReservation']);
    Route::put('/{id}', [ReservationController::class, 'updateReservation']);
    Route::delete('/{id}', [ReservationController::class, 'deleteReservation']);
});
Route::get('/{id}', [ReservationController::class, 'findReservationById']);

