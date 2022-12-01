<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\Authenticate;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\LoginWithFacebookController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/search', [HomeController::class, 'search'])->name('search');


    #Hotels
    Route::group(['prefix' => 'hotel', 'as' => 'hotel.'], function(){
        Route::get('/create', [HotelController::class, 'create'])->name('create');
        Route::post('/store', [HotelController::class, 'store'])->name('store');
        Route::get('/show/{hotel_id}', [HotelController::class, 'show'])->name('show');
    });

    #Images
    Route::group(['prefix' => 'image', 'as' => 'image.'], function(){
        Route::get('/create/{hotel_id}', [ImageController::class, 'create'])->name('create');
        Route::post('/store', [ImageController::class, 'store'])->name('store');
    });

    #Reservation
    Route::group(['prefix' => 'reservation', 'as' => 'reservation.'], function(){
        Route::post('/{hotel_id}/store', [ReservationController::class, 'store'])->name('store');
        Route::get('/{room_id}/book', [ReservationController::class, 'book'])->name('book');

        #Booking
        Route::get('/booking', [ReservationController::class, 'booking'])->name('booking');
        Route::delete('/booking/{id}/destroy', [ReservationController::class,'destroy'])->name('destroy');
    });

    #Room
    Route::group(['prefix' => 'room', 'as' => 'room.'], function(){
        Route::get('/create/{hotel_id}', [RoomController::class, 'create'])->name('create');
        Route::post('/store/{hotel_id}/{room_id}', [RoomController::class, 'store'])->name('store');
    });

    #Comment
    Route::group(['prefix' => 'comment' , 'as' => 'comment.'], function(){
        Route::post('/{hotel_id}/store',[CommentController::class,'store'])->name('store');
        Route::delete('/{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
    });

    #user
    Route::get('/user_profile', [HomeController::class, 'show_user_profile'])->name('show_user_profile');
    Route::patch('/{id}/update', [HomeController::class, 'update'])->name('update');
});

Route::group(['prefix' => 'login'], function(){
    #Google
    Route::get('/google', [LoginWithGoogleController::class,'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [LoginWithGoogleController::class,'handleGoogleCallback'])->name('google.callback');
    #Facebook
    Route::get('/facebook', [LoginWithFacebookController::class, 'redirectToProvider'])->name('facebook.redirect');
    Route::get('/facebook/callback', [LoginWithFacebookController::class, 'handleProviderCallback'])->name('facebook.callback');
});
