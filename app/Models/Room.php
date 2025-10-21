<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $room_type
 * @property string $room_number
 * @property string $floor_number
 * @property string $hotel_id
 * @property string $reservation_status
 * @property string $created_at
 * @property string $updated_at
 */
class Room extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'room_type',
        'room_number',
        'floor_number',
        'hotel_id',
        'reservation_status',
    ];
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

}
