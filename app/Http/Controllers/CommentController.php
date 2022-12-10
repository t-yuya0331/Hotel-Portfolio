<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $comment;
    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request, $hotel_id)
    {
        $request->validate([
            'body'      => 'required|min:2|max:180',
            'rating'    => 'required'
        ]);

        $this->comment->user_id = Auth::user()->id;
        $this->comment->hotel_id = $hotel_id;
        $this->comment->body = $request->body;
        $this->comment->stars = $request->rating;

        $this->comment->save();
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
