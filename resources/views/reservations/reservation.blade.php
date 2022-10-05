@extends('layouts.app')

@section('title', 'Reservation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('reservation.store', $hotel->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="type">Room Type</label>
                    <select name="type" id="type">
                        <option value="hidden">Slect the type of room</option>
                        <option value="1">Single Room</option>
                        <option value="2">Twin Room</option>
                        <option value="3">Sweet Room</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="number_of_rooms">Number Of Room</label>
                    <input type="number" name="number_of_rooms" id="number_of_rooms" min="1">
                </div>

                <div class="mb-3">
                    <label for="check_in">Check In</label>
                    <input type="date" name="check_in" id="check_in">
                </div>

                <div class="mb-3">
                    <label for="check_out">Check Out</label>
                    <input type="date" name="check_out" id="check_out">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">
                        Reservation
                    </button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="card-header">{{ $calendar->getTitle() }}</div>
                <div class="card-body">
					{!! $calendar->render() !!}
                </div>
        </div>
        </div>
    </div>

@endsection
