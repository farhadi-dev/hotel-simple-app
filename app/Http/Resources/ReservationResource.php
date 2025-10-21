<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Reservation
 */
class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'room_id'=>$this->room_id,
            'user_id'=>$this->user_id,
            'check_in'=>$this->check_in,
            'check_out'=>$this->check_out,
            'status'=>$this->status,
        ];
    }
}
