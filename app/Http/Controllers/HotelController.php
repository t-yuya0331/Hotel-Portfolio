<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $hotel;

    public function __construct(Hotel $hotel){
        $this->hotel = $hotel;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_hotel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name'          => 'required|min:2|max:20',
        //     'location'      => 'required|min:1|max:20',
        //     'description'   => 'required|min:1|max:1000',
        //     'image'         => 'required|mimes:jpg, jpeg, png, gif|max:1048'
        // ]);

        $this->hotel->name = $request->name;
        $this->hotel->location = $request->location;
        $this->hotel->description = $request->description;
        $this->hotel->image = base64_encode(file_get_contents($request->image));


        $this->hotel->save();
        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($hotel_id )
    {
        $hotel = $this->hotel->findOrFail($hotel_id);

        return view('hotels.hotel_details')->with('hotel', $hotel);
    }
}
