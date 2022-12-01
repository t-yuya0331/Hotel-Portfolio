@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="userIcon text-center mt-3 mx-auto">
                        <i class="fas fa-user fa-3x mt-4"></i>
                    </div>
                    <h2 class="title mt-3 text-center" id="test">WELCOME</h2>

                    <form method="POST" action="{{ route('login') }}" class="mt-5">
                        @csrf
                        <div class="row mb-3 signIcon">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-envelope" ></i>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 signIcon">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-lock"></i>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="loginButton text-center">
                                <button type="submit" class="btn w-25 text-white">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <p>下記のログイン方法もご利用できます</p>
                            <div class="col-1 text-end">
                                <a href="{{ route('google.redirect') }}">
                                    <img src="images/google.png" alt="google_image" height="20px" width="20px">
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="#">
                                    <img src="images/facebook.png" alt="facebook_image" height="20px" width="20px">
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
