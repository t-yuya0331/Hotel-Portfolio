@extends('layouts.app')

@section('title', 'Reservation')

@section('content')
<div class="reservation_form mt-5">
    <div class="section-header">
        <h2 class="text-center">Reservation Form</h2>
        <hr>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-5 border border-dark">
            <form action="{{ route('reservation.store', $hotel->id) }}" method="post">
                @csrf
                <div class="row text-center">
                    <h5 class="mt-3">Hotel:&nbsp;{{$hotel->name}}</h5>
                </div>

                <div class="row mt-3">
                    <div class="col-9">
                        <div class="form-section">
                            <div class="form-group">
                                <p class="d-inline">Room Type:&nbsp;</p>
                                <label for="type">
                                    @if ($room->type == App\Constants\RoomType::SingleRoom)
                                        Single Room
                                    @elseif ($room->type == App\Constants\RoomType::TwinRoom)
                                        Twin Room
                                    @elseif ($room->type == App\Constants\RoomType::SweetRoom)
                                        Sweet Room
                                    @endif
                                </label>
                                <input type="number" name="type" id="type" hidden
                                @if ($room->type == App\Constants\RoomType::SingleRoom)
                                value= "1"
                                @elseif ($room->type == App\Constants\RoomType::TwinRoom)
                                value= "2"
                                @elseif ($room->type == App\Constants\RoomType::SweetRoom)
                                value= "3"
                                @endif  >
                            </div>
                            <div class="form-group">
                                <label for="number_of_rooms" id="right-side">Number Of Room:&nbsp;</label>
                                <input type="number" name="number_of_rooms" id="number_of_rooms" min="1" max="{{ $room->availableRooms($room->type) }}">
                                <div class="error">
                                    @error('number_of_rooms')
                                        <span class="errorMessage text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="check_in">Check In:</label>
                                <input type="date" name="check_in" id="check_in" min="{{ $today }}" required >
                            </div>
                            <div class="form-group">
                                <label for="check_out" id="right-side">Check Out:</label>
                                <input type="date" name="check_out" id="check_out" min="{{ $tomorrow }}" required >
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>

                <div class="row mt-5" id="reservation_form_button">
                    <div class="reservation_button text-center">
                        <button type="submit" class="btn w-50 text-white">
                            Reservation
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
