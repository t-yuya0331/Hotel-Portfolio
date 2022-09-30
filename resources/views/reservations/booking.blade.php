@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-5">
            @if ($bookings)
                <div class="row">
                    @foreach ($bookings as $booking)
                        <div class="col-3">
                            <div class="card p-0 shadow">
                                <div class="card-header">
                                    <img src="data:image/png;base64,{{ $booking->hotel->image }}" alt="{{ $booking->hotel->image }}" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    {{ $booking->hotel->name }}
                                </div>

                                <div class="card-footer">
                                    <p>
                                        Check IN: &nbsp; {{ $booking->check_in }}
                                    </p>
                                    <p>
                                        Check OUT: &nbsp; {{ $booking->check_out }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection
