@extends('layouts.app')

@section('title','Show Hotel_detail')

@section('content')
    <div class="d-flex justify-content-center">
            <div class="col-md-5">
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

                <div class="card mt-3">
                    <div class="card-header">
                        <p>{{ $hotel->name }}</p>
                        <img src="data:image/png;base64,{{ $hotel->image }}" alt="{{ $hotel->image }}" class="img-fluid" style="width:40%; height:40%;">
                    </div>

                    <div class="card-body">
                        <p>Surrounding Scenery</p>
                        <div class="row">
                            @foreach ($hotel->images as $image)
                                <div class="col">
                                    <img src="data:image/png;base64,{{ $image->name }}" alt="{{ $image->name }}" class="card-img-top img-fluid" style="height:80%; width:80%;">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer">
                        <p>Location: &nbsp; {{ $hotel->location }}</p>
                        <p class="text-warning mt-3">Room Details</p>

                        <table class="table table-hover align-middle border ">
                            <thead class=" small ">
                                <tr>
                                    <th></th>
                                    <th>Room Type</th>
                                    <th>Room Price</th>
                                    <th>Room Vacancy</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotel->rooms as $room)
                                <tr>
                                    <td></td>
                                    <td>
                                        @if ($room->type == App\Constants\RoomType::SingleRoom)
                                            Single Room
                                        @elseif ($room->type == App\Constants\RoomType::TwinRoom)
                                            Twin Room
                                        @elseif ($room->type == App\Constants\RoomType::SweetRoom)
                                            Sweet Room
                                        @endif
                                    </td>
                                    <td>{{ $room->price }}</td>
                                    <td>{{ $room->rooms}}</td>
                                    <td>
                                        <img src="data:image/png;base64,{{ $room->name }}" alt="{{ $room->name }}" style="height:50%; width:50%;">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <p class="mt-5 text-center">
                            <a href="{{ route('reservation.book', $hotel->id) }}" class="btn btn-success">
                                Reservation Form
                            </a>
                        </p>
                    </div>
                </div>
            </div>
    </div>

@endsection
