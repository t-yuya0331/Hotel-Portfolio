@extends('layouts.app')

@section('title','Show Hotel_detail')

@section('content')
    <div class="d-flex justify-content-center">
            <div class="col-md-5" id="hotel_detail_container">
                @if(Auth::user()->role_id == 1)
                    <div class="add_room_images">
                        <a href="{{ route('image.create', $hotel->id) }}">
                            Add Images
                        </a>
                    </div>
                    <div class="add_room_details">
                        <a href="{{ route('room.create', $hotel->id) }}">
                            Add Room Details
                        </a>
                    </div>
                @endif
                <div class="row" id="hotel_detail_header">
                    <h4>{{ $hotel->name }}</h4>
                    <hr>
                </div>

                <div class="hotel_details">
                    <div class="card">
                        <div class="card-header" id="hotel_images" >
                            <div class="row">
                                <div class="col pe-0">
                                    <img src="data:image/png;base64,{{ $hotel->image }}" alt="{{ $hotel->image }}" class="img-fluid">
                                </div>
                                <div class="col">
                                    <div class="row">
                                        @foreach ($hotel->images as $image)
                                        <div class="col ps-0" >
                                            <img src="data:image/png;base64,{{ $image->name }}" alt="{{ $image->name }}" class="card-img-top" style="height:100%; width:50%;">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body mt-3" id="all_comments">
                            <div class="h5">Comment</div>
                            <div class="row">
                                <div class="col" >
                                    @if ($hotel->comments )
                                            @foreach ($hotel->comments as $comment)
                                                <div class="row mb-2">
                                                    <div class="col-2 text-center p-0">
                                                        <i class="fa-regular fa-comment"></i>
                                                    </div>
                                                    <div class="col-8 text-start p-0">
                                                        <p class="comment mb-0 " >
                                                            {{ $comment->body }}
                                                        </p>
                                                        <hr class="mt-0">
                                                    </div>
                                                    <div class="col">
                                                        @if ($comment->user->id == Auth::user()->id)
                                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn text-danger shadow-none btn-sm"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                    @else
                                        <div class="row">
                                            <p>No comment</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-0">
                            <table class="table table-hover align-middle border ">
                                <thead class="small">
                                    <tr>
                                        <th>&nbsp;&nbsp;  Type</th>
                                        <th>Price</th>
                                        <th>Vacancy</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotel->rooms as $room)
                                    <tr>
                                        <td>
                                            @if ($room->type == App\Constants\RoomType::SingleRoom)
                                                Single Room
                                            @elseif ($room->type == App\Constants\RoomType::TwinRoom)
                                                Twin Room
                                            @elseif ($room->type == App\Constants\RoomType::SweetRoom)
                                                Sweet Room
                                            @endif
                                        </td>
                                        <td class="ps-2">{{ $room->price }}</td>
                                        <td class="pe-0">{{ $room->availableRooms($room->type) }}</td>
                                        <td class="px-0">
                                            <img src="data:image/png;base64,{{ $room->name }}" alt="{{ $room->name }}"  id="room_img">
                                        </td>
                                        <td>
                                            @if ($room->availableRooms($room->type) >= 1)
                                            <a href="{{ route('reservation.book', $room->id) }}" class="btn btn-success" id="reservation_button">
                                                Reserve
                                            </a>
                                            @else
                                                <p class="text-warning">No vacancyf</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection
