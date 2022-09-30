<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $hotel;

    public function __construct(Hotel $hotel)
    {
        $this->middleware('auth');
        $this->hotel = $hotel;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_hotels = $this->hotel->latest()->paginate(3);

        return view('home')->with('all_hotels', $all_hotels);
    }
}
