<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    public function show()
    {
        return view('site.pages.forgot-password'); 
    }
    public function store(Request $request)
    { 
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Password::sendResetLink( $request->only('email'));
        // دي ميثود جاهزة في Laravel (من Facade اسمه Password).
        // مهمتها:
        // تدور في جدول users هل في يوزر عنده الإيميل ده ولا لأ.
        // لو موجود → تولّد token.
        // تخزن الـ token ده في جدول password_resets.
        // بيرجع status code
        // تبعت Notification لليوزر (الإيميل اللي فيه لينك Reset Password).
        //بتدور ع route name اسمه password.reset

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))   // رسالة نجاح
            : back()->withErrors(['email' => __($status)]); // رسالة خطأ
    }
    public function create(Request $request, $token)
    {
        return view('site.pages.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.show')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
