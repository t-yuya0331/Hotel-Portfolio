@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hotel_postings">
        <div class="row justify-content-center">
        <div class="col-md-7">
            @if($all_hotels->isNotempty())
                @foreach ($all_hotels as $hotel)
                    <div class="card mb-4">
                        <div class="card-header">
                            <p>{{ $hotel->name }}</p>
                            <p>Location:&nbsp; {{ $hotel->location }}</p>
                            <p>Status:&nbsp;{{ $hotel->status }}</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('hotel.show', $hotel->id) }}">
                                <img src="data:image/png;base64,{{ $hotel->image }}" alt="{{ $hotel->image }}" class="img-fluid" style="width:40%; height:40%;">
                            </a>
                        </div>
                        <div class="card-footer">
                            <p>{{ $hotel->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    </div>
</div>
{!! $all_hotels->links() !!}
@endsection
