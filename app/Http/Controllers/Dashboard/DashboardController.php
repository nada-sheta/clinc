<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateAccountRequest;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\DoctorApplication;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $doctorCount = Doctor::count();
        $bookingCount = Booking::count();
        $PatientCount = User::where('is_user', 1)->count(); // بيعد عدد اليوزرز العاديين
        return view("dashboard.pages.home",compact('doctorCount', 'PatientCount','bookingCount'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
            $request->session()->regenerateToken();
        return redirect()->route('dashboard.login.show');
    }
    public function create()
    {
        return view("dashboard.pages.add_admins");
    }
    public function store(CreateAccountRequest $request)
    {
        $uploadedFile = null;
        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $uploadedFile,
            'password'=>Hash::make($request->input('password')),
            'is_admin' => true,
            'is_user' => true,
            'is_doctor' => false,
        ]);
        return redirect()->back()->with('success', 'Stored successfully!');
    }
    public function destroy(DoctorApplication $request)
    {
        $request->delete();
        return redirect()->back();
    }
}
