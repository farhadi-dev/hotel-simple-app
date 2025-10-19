<?php

namespace App\Models;

use App\Observers\ReservationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ReservationObserver::class])]
class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'date',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
