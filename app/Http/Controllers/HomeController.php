<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $hotel;
    private $user;

    public function __construct(Hotel $hotel, User $user)
    {
        $this->middleware('auth');
        $this->hotel = $hotel;
        $this->user = $user;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');

        if(Auth::user()->reservations){
            $reservations = Reservation::where('user_id', Auth::user()->id)
                                        ->get();
            foreach($reservations as $reservation){
                if( $reservation->check_out <= $date){
                    $reservation->update([
                        'status' => 'old'
                    ]);
                }
            }
        }
        $all_hotels = $this->hotel->latest()->paginate(3);

        return view('home')->with('all_hotels', $all_hotels);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $upper_keyword = ucfirst($keyword);
        $location = $request->input('location');
        $upper_location = ucfirst($location);

        $query = Hotel::query();

        if(!empty($keyword) && !empty($location)) {
            $query  ->where('name', 'LIKE',"%{$keyword}%" )
                    ->where('name', 'LIKE',"%{$upper_keyword}%" )
                    ->Where('location', 'LIKE', "%{$location}%")
                    ->Where('location', 'LIKE', "%{$upper_location}%");
        }

        if(!empty($keyword)) {
            $query  ->where('name', 'LIKE',"%{$keyword}%" )
                    ->where('name', 'LIKE',"%{$upper_keyword}%" );
        }

        if(!empty($location)) {
            $query  ->where('location', 'LIKE', "%{$location}%")
                    ->where('location', 'LIKE', "%{$upper_location}%");
        }

        $search_hotels = $query->get();

        return view('hotels/search_hotel')->with('search_hotels', $search_hotels);
    }

    public function show_user_profile(){
        $user = Auth::user();

        return view('user.profile')->with('user', $user);
    }
    public function update(Request $request,$id ){
        $user = $this->user->findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();
        return redirect()->route('index');
    }

}
