<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception; // أو use Illuminate\Foundation\Exceptions\Handler;

class GoogleController extends Controller{
//    public function redirectToGoogle()
//     {
//         $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
//         return response()->json([
//             'status' => 'success',
//             'redirect_url' => $url
//         ], 200);
//     }

//     public function handleGoogleCallback()
//     {
//         try {
//             $googleUser = Socialite::driver('google')->stateless()->user();

//             $user = User::where('email', $googleUser->getEmail())->first();

//             if (!$user) {
//                 $user = User::create([
//                     'name' => $googleUser->getName(),
//                     'email' => $googleUser->getEmail(),
//                     'password' => bcrypt(Str::random(16)),
//                 ]);
//             }

//             Auth::login($user);

//             $token = $user->createToken('API Token')->plainTextToken;

//             return response()->json([
//                 'status' => 'success',
//                 'message' => $user->wasRecentlyCreated ? 'تم إنشاء الحساب بنجاح باستخدام جوجل' : 'تم تسجيل الدخول بنجاح',
//                 'user' => $user,
//                 'token' => $token
//             ], 200);

//         } catch (Exception $e) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'فشل تسجيل الدخول باستخدام جوجل',
//                 'error' => $e->getMessage()
//             ], 401);
//         }
//     }
}