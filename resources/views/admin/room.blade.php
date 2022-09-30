@extends('layouts.app')

@section('title', 'Add Images')

@section('content')

<div class="container mx-auto mt-5">
    <form action="{{ route('room.store', $hotel->id) }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="mb-3 w-50">
            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

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
            <label for="price">Room Price:&nbsp;</label>
            <input type="number" name="price" id="price">
        </div>
        <div class="mb-3">
            <label for="number">Room Capacity:&nbsp;</label>
            <input type="number" name="number" id="number">
        </div>
        <div class="w-50">
            <button type="submit" class="btn btn-primary w-100">Add Room</button>
        </div>


    </form>
</div>
@endsection
