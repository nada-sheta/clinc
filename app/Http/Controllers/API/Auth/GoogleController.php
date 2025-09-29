<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    // public function redirectToGoogle()
    // {
    //     /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
    //     $driver = Socialite::driver('google');
    //     $url = $driver->stateless()->redirect()->getTargetUrl();

    //     $url = Socialite::driver('google')
    //                 ->stateless() 
    //                 ->redirect()
    //                 ->getTargetUrl(); 

    //     return response()->json([
    //         'url' => $url
    //     ]);
    // }
    // public function handleGoogleCallback(Request $request)
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->stateless()->user();

    //        $user = User::where('email', $googleUser->getEmail())->first();

    //         if (!$user) {
    //             $user = User::create([
    //                 'name'     => $googleUser->getName(),
    //                 'email'    => $googleUser->getEmail(),
    //                 'password' => bcrypt(Str::random(16)),
    //                 //Str::random(16)
    //                 //دي بتولد سلسلة عشوائية طولها 16 حرف
    //                 //bcrypt(...)
    //                 //دي بتعمل هاش للباسورد اللي اتولد
    //             ]);
    //         }

    //         // لو عندك Sanctum أو Passport
    //         $token = $user->createToken('api-token')->plainTextToken;

    //         return response()->json([
    //             'user'  => $user,
    //             'token' => $token
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Google login failed!',
    //             'message' => $e->getMessage()
    //         ], 400);
    //     }
    // }
}
