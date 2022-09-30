@extends('layouts.app')

@section('title', 'Add Images')

@section('content')

<div class="container mx-auto mt-5">
    <form action="{{ route('image.store', $hotel->id) }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="mb-3 w-50">
            <input type="hidden" name="hotel_id" value="{{ $hotel_id }}">
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-50">
            <button type="submit" class="btn btn-primary w-100">Add an Image</button>
        </div>


    </form>
</div>
@endsection
