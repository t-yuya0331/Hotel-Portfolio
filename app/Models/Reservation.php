<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function totalPrice($id){
        $reservation = Reservation::findOrFail($id);
        $date = (strtotime($reservation->check_out) - strtotime($reservation->check_in))/86400;
        $price =$reservation->room->price * $date;

        return $price;
    }

}
