<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Socialite;


class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver("google")->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver("google")->stateless()->user();
            $user = User::where("email", $googleUser->email)->first();

            if ($user) {
                Auth::login($user);

                return redirect('/');
            } else {
                $newUser = User::create([
                    "name" => $googleUser->name,
                    "email" => $googleUser->email,
                    "google_id" => $googleUser->id,
                    "password" => Hash::make(uniqid()),
                ]);

                Auth::login($newUser);

                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
