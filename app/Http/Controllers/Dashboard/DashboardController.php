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
use App\Models\Rating;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $doctorCount = Doctor::count();
        $bookingCount = Booking::count();
        $ratingCount = Rating::count();
        $PatientCount = User::where('is_user', 1)->count(); 
        $dailyBookings = Booking::whereDate('booking_date', Carbon::today())->count();
        $weeklyBookings = Booking::whereBetween('booking_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $monthlyBookings = Booking::whereMonth('booking_date', Carbon::now()->month)
                                ->whereYear('booking_date', Carbon::now()->year)
                                ->count();
        $yearlyBookings = Booking::whereYear('booking_date', Carbon::now()->year)->count();
        return view("dashboard.pages.home",compact('doctorCount', 'PatientCount','bookingCount','ratingCount',
                   'dailyBookings', 'weeklyBookings', 'monthlyBookings', 'yearlyBookings'));
    }
    public function patients()
    {
        $patients = User::where('is_user', 1)->get();
        return view("dashboard.pages.patients",compact('patients'));
    }
    public function bookings()
    {
        $bookings = Booking::with(['doctor.major', 'user'])->get();
        return view("dashboard.pages.bookings",compact('bookings'));
    }
    public function ratings()
    {
        $ratings =  Rating::with(['doctor', 'user'])->get();
        return view("dashboard.pages.ratings",compact('ratings'));
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

    public function index2()
    {

    // الإيرادات: عدد حجوزات كل دكتور × سعره
    $doctorRevenues = Doctor::withCount('bookings')
        ->get()
        ->map(function ($doctor) {
            return [
                'name' => $doctor->user->name,
                'total_revenue' => $doctor->bookings_count * $doctor->price,
            ];
        });
}
}
