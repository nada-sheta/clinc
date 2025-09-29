<?php

namespace App\Http\Controllers\AuthGoogle;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name'     => $googleUser->getName(),
                    'email'    => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    //Str::random(16)
                    //دي بتولد سلسلة عشوائية طولها 16 حرف
                    //bcrypt(...)
                    //دي بتعمل هاش للباسورد اللي اتولد
                ]);
            }


            Auth::login($user);

            return redirect()->route('profile.user'); 
        } catch (\Exception $e) {
            return redirect()->route('login.show')->with('error', 'Google login failed!');
        }
    }
}
