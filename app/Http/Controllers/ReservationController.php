<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Calendar\CalendarView;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $reservation;
    private $hotel;
    private $room;

    public function __construct(Reservation $reservation, Hotel $hotel, Room $room){

        $this->reservation = $reservation;
        $this->hotel = $hotel;
        $this->room = $room;
    }

    public function book($room_id){
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $room = $this->room->findOrFail($room_id);
        $hotel = $room->hotel;
        return view('reservations.reservation')->with('hotel', $hotel)
                                                ->with('room', $room)
                                                ->with('today', $today)
                                                ->with('tomorrow', $tomorrow);
    }

    public function store(Request $request, $hotel_id)
    {
        $room = Room::where('hotel_id', $hotel_id)
        ->where('type', $request->type)
        ->first();

        $request->validate([
            'number_of_rooms' => 'required'
        ]);

        $this->reservation->user_id = Auth::user()->id;
        $this->reservation->hotel_id = $hotel_id;
        $this->reservation->room_id = $room->id;
        $this->reservation->number_of_rooms = $request->number_of_rooms;
        $this->reservation->type = $request->type;
        $this->reservation->check_in = $request->check_in;
        $this->reservation->check_out = $request->check_out;
        $this->reservation->save();

        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking()
    {
        $bookings = Reservation::where('user_id' , Auth::user()->id)->where('status', 'upcoming')->orderBy('check_in', 'asc')->get();

        return view('reservations.booking')->with('bookings', $bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = $this->reservation->findOrFail($id);
        $this->reservation->destroy($id);

        return redirect()->back();
    }
}
