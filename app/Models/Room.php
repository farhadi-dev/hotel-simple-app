<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
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
