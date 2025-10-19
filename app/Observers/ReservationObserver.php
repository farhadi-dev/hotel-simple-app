<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Models\Room;

class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     */
    public function created(Reservation $reservation): void
    {
        $room = Room::find($reservation->room_id); // fetch the actual Room model
        $room->reservation_status = false; // or 0
        $room->save();
    }

    /**
     * Handle the Reservation "updated" event.
     */
    public function updated(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "deleted" event.
     */
    public function deleted(Reservation $reservation): void
    {
        $room = Room::find($reservation->room_id);
        $room->reservation_status = true;
        $room->save();
    }

    /**
     * Handle the Reservation "restored" event.
     */
    public function restored(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "force deleted" event.
     */
    public function forceDeleted(Reservation $reservation): void
    {
        //
    }
}
