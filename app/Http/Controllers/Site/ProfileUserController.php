<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Models\Booking;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileUserController extends Controller
{
public function profile_user()
{
    if (Gate::allows('is-user')) {
        $user = auth()->user(); 
        $bookings = Booking::with('doctor')->where('booking_date', '>=', now())
        ->where('user_id', $user->id)
        ->get();
        return view("site.pages.profile_user", compact('bookings','user'));
        // return dd($user->id) ;
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
    public function edit_name(User $user)
    {
        return view('site.pages.edit_name',compact('user'));
    }
    public function edit_email(User $user)
    {
        return view('site.pages.edit_email',compact('user'));
    }
    public function edit_password(User $user)
    {
        return view('site.pages.edit_password',compact('user'));
    }
    public function edit_image(User $user)
    {
        return view('site.pages.edit_image',compact('user'));
    }
    public function update_name(Request $request, User $user)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        ]);
        $user->update([
        'name' => $request->name,
        ]);
        return redirect()->route('profile.user')->with('success', 'Update completed');
    }
    public function update_email(Request $request, User $user)
    {
        $request->validate([
        'email'    => 'required|email|unique:users,email',
        ]);
        $user->update([
        'email' => $request->email,
        ]);
        return redirect()->route('profile.user')->with('success', 'Update completed');
    }
    public function update_image(Request $request, User $user)
    {
        $data = $request->validate([
        'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // $user->update([
        // 'image' => $request->image,
        // ]);
        $file = $request->hasFile('image');
        if($file){
            $filename = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $filename ;
        }
        $user->update($data);
        return redirect()->route('profile.user')->with('success', 'Update completed');
    }
    public function update_password(Request $request, User $user)
    {
        $request->validate([
        'password' => 'required|string|min:6',
        ]);
        $user->update([
        'password' => Hash::make($request->password),
        ]);
        return redirect()->route('profile.user')->with('success', 'Update completed');
    }
}
