<?php

namespace App\Models;

use App\Observers\ReservationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $user_id
 * @property $room_id
 * @property $check_in
 * @property $check_out
 * @property $status
 * @property $created_at
 * @property $updated_at
 */
#[ObservedBy([ReservationObserver::class])]
class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
