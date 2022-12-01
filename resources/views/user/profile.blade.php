@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-6 border border" id="user_form">
            <form action="{{ route('update',$user->id) }}" method="post">
            @csrf
            @method('PATCH')
                <div class="userIcon mx-auto mt-3" id="profile">
                    <i class="fa-solid fa-circle-user"></i>
                </div>

                <div class="user_profile">
                    <div class="row mt-4">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"class="form-control" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="phone" class="form-label">ContactNumber</label>
                            <input type="tel" name="phone" id="phone"class="form-control" value="{{ $user->phone }}"maxlength="11">
                        </div>
                        <div class="col text-center">
                            <button type="submit" class="edit_button mt-4">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
