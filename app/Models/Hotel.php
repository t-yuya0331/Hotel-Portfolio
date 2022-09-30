<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Hotel extends Model
{
    use HasFactory;

    public function reservations(){
        return $this->hasMany(Reservation::class)->where('user_id',Auth::user()->id);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
