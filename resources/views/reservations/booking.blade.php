@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')

<div class="user_bookings d-flex justify-content-center">
    <div class="col-md-6">
        @if ($bookings->isNotEmpty())
            <table class="table table-hover align-middle border text-secondary mt-5">
                <thead class="small table-success">
                    <tr>
                        <th>Hotel</th>
                        <th>Check_In</th>
                        <th>Check_Out</th>
                        <th>Price</th>
                        <th>Cancel</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                <img src="data:image/png;base64,{{ $booking->hotel->image }}" alt="{{ $booking->hotel->image }}" class="card-img-top"   style="height:20%; width:300px;" >
                            </td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                            <td>{{$booking->totalPrice($booking->id)}}</td>
                            <td>
                                <form action="{{ route('reservation.destroy', $booking->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn text-danger shadow-none btn-sm" id="trash"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center mt-5">No bookings</h3>
        @endif
    </div>
</div>


@endsection
