
@extends('layouts.app')

@section('title','Show Hotel_detail')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="hotel-posts">
                @if($search_hotels->isNotempty())
                    @foreach ($search_hotels as $hotel)
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
{{-- {!! $search_hotels->links() !!} --}}
@endsection
