<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminLoginController extends Controller
{
    public function show()
    {
        return view("dashboard.pages.login");
    }

    public function auth(LoginRequest $request)
    {
        $data = $request->validated();
        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt(array_merge($data, ['is_admin' => true]), $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard/home');
        }

        return back()->withErrors([
            'email' => 'You are not authorized as an admin.',
        ])->onlyInput('email');
    }

}
