<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Socialite;


class LoginWithFacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleProviderCallback()
    {

            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user= User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id
                ]);
            }else{
                Auth::login($user);

                return redirect('/');
            }


    }
}
