@extends('layouts.app')

@section('content')
<div class="container" id="home">
    <div class="row justify-content-center">
        <div class="col-3" id="search_area">
            <div class="search-area">
                <form class="search_area" action="{{ route('search') }}" method="GET" >
                @csrf
                    <div class="row" id="search_area_header">
                        <p class="text-white"><span>宿名・場所</span>から探す</p>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="keyword" class="form-label">Name</label>
                            <input class="form-control me-2 w-100" type="text" name="keyword" id="keyword" placeholder="Name"aria-label="Search" value="{{ old('keyword') }}" minlength="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="{{ old('location') }}" placeholder="Location" id="location">
                        </div>
                    </div>
                    <div class="row mt-3 text-center">
                        <button class="btn btn-primary w-75 mx-auto" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7 mx-0" id="hotel_posts" >
            <div class="hotel-posts">
                @if($all_hotels->isNotempty())
                    @foreach ($all_hotels as $hotel)
                        <div class="card mb-4">
                            <div class="card-header border border-none">
                                <h5>
                                    <a href="{{ route('hotel.show', $hotel->id) }}" class="py-3">
                                        {{ $hotel->name }}
                                    </a>
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-3 pe-0">
                                        <a href="{{ route('hotel.show', $hotel->id) }}">
                                            <img src="data:image/png;base64,{{ $hotel->image }}" alt="{{ $hotel->image }}" class="img" id="home_hotel_img">
                                        </a>
                                    </div>
                                    <div class="col ps-1">
                                        <div class="card" id="comments">
                                            @include('comments.comment')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0 mt-2" id="price">
                                <h5 class="mt-2 ms-3">[料金]</h5>
                                <div class="price_container text-center">
                                    @foreach ($hotel->rooms as $hotel_room)
                                        @if ($hotel_room->type == App\Constants\RoomType::SingleRoom)
                                            <p>Single Room:&nbsp;{{ $hotel_room->price }}$</p>
                                        @elseif ($hotel_room->type == App\Constants\RoomType::TwinRoom)
                                            <p>Twin Room:&nbsp;{{ $hotel_room->price }}$</p>
                                        @elseif ($hotel_room->type == App\Constants\RoomType::SweetRoom)
                                            <p>Sweet Room:&nbsp;{{ $hotel_room->price }}$</p>
                                        @endif
                                    @endforeach
                                </div>

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
