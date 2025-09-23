<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateAccountRequest;
use App\Models\Rating;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileDoctorController extends Controller
{
    public function profile_doctor()
    {
    if (Gate::allows('is-doctor')) {
        $doctor = auth()->user();
        $bookings = Booking::whereHas('doctor.user', function($query) use ($doctor) {
        $query->where('id', $doctor->id);
        })->with(['doctor.user'])->get();

        return view("site.pages.profile_doctor",compact('bookings','doctor'));
    }
    else{
            Session::flush();
            Auth::logout();
            return redirect()->route('login.show');
    }
    }
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back();
    }
    public function edit(User $doctor)
    {
        return view('site.pages.edit_doctor',compact('doctor'));
    }
    public function update(Request $request, User $doctor)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes','email', Rule::unique('users')->ignore($doctor->id)],
            'password' => 'nullable|min:6|confirmed', 
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = [
        'name' => $request->name ?? $doctor->name,
        'email' => $request->email ?? $doctor->email,
        'password' => $request->password ? Hash::make($request->password) : $doctor->password,
        'image' => $doctor->image, // احتياطي يفضل يحتفظ بالصورة القديمة
        ];
        $file = $request->hasFile('image');
        if($file){
            $filename = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $filename ;
        }
        $doctor->update($data);
        return redirect()->route('profile.doctor')->with('success', 'Update completed');
    }

    public function show_rating()//ميثود الريتنج الخاصة بالدكتور اللي عامل لوج ان
    {
    $doctor = auth()->user();
    $doctor2 = Doctor::where('account_doctor', auth()->id())
                    ->with(['ratings.user'])
                    ->firstOrFail();

    $ratings = $doctor2->ratings; // جاهزة ومعاها بيانات اليوزر
    return view('site.pages.show_rating', compact('doctor', 'ratings'));
    }
    public function destroy_rate(Rating $rate)
    {
        $rate->delete();
        return redirect()->back();
    }
    public function edit_info()
    {
    $doctor = auth()->user()->doctor;
    return view('site.pages.edit_doctor_info', compact('doctor'));
    }
    public function updateDoctorInfo(Request $request)
{
    $doctor = auth()->user()->doctor;
    $request->validate([
            'name' => 'sometimes|string|max:255',
            'booking_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    $data = [
        'name' => $request->name ?? $doctor->name,
        'booking_price' => $request->booking_price ?? $doctor->booking_price,
        'description' => $request->description ?? $doctor->description,
        'image' => $doctor->image, 
        ];

            $file = $request->hasFile('image');
        if($file){
            $filename = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $filename ;
        }
        $doctor->update($data);

    return redirect()->route('profile.doctor')->with('success', 'Doctor information updated successfully');
}

}

