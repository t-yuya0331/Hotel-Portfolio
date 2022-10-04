<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function availableRooms($type) {
        $date = Carbon::now()->format('Y-m-d');
        // use this you want to just check base on the current date
        // $date = Carbon::parse($date)->format('Y-m-d'); // use this if you are passing a date

        $reservations = Reservation::where('check_in', '<=', $date)
            ->where('check_out', '>', $date)
            ->where('hotel_id', $this->hotel->id)
            ->get()
            ->filter(function($reservation) use($type) {
                return $reservation->type == $type;
            })->pluck('number_of_rooms')->toArray();

        $reservation_count = array_sum($reservations);

        return $this->rooms - $reservation_count;
    }
}
