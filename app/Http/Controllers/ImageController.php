<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $image;
    private $hotel;

    public function __construct(Image $image, Hotel $hotel){
        $this->image = $image;
        $this->hotel = $hotel;
    }

    public function create($hotel_id){
        $hotel = $this->hotel->findOrFail($hotel_id);

        return view('admin.images')
                ->with('hotel', $hotel)
                ->with('hotel_id',$hotel_id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg, jpeg, png, gif|max:1048'
        ]);

        $this->image->name = base64_encode(file_get_contents($request->image));
        $this->image->hotel_id = $request->hotel_id;

        $this->image->save();
        return redirect()->route('index');
    }


}

