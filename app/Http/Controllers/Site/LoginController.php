<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function show()
    {
        return view("site.pages.login");
    }
    public function auth(LoginRequest $request)
    {
        $data = $request->validated();
        $remember = $request->has('remember');
        if (Auth::guard('web')->attempt($data, $remember)) {
            $request->session()->regenerate();
            if (Gate::allows('is-user')) {
                return redirect()->route('profile.user');
            } elseif (Gate::allows('is-doctor')) {
                return redirect()->route('profile.doctor');
            } else {
                // لو المستخدم مش يوزر ولا دكتور (مثلاً admin أو حالة غير متوقعة)
                Auth::guard('web')->logout();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }
            // return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
