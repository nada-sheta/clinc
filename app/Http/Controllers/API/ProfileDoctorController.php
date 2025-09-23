<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileDoctorController extends Controller
{
    public function profile_doctor(Request $request)
{
    if ($request->user()->tokenCan('doctor')) {
        $doctor = $request->user();

        $bookings = Booking::whereHas('doctor.user', function($query) use ($doctor) {
            $query->where('id', $doctor->id);
        })->get(['id', 'name', 'email', 'phone', 'booking_date']);

        return response()->json([
            'doctor'   => $doctor->only('id', 'name', 'email', 'phone', 'image'),
            'bookings' => $bookings
        ]);
    } else {
        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }
}
public function update_data(Request $request)
{
    AbilityHelper::authorize($request, 'doctor');
    $doctor = $request->user()->doctor;

    if (! $doctor) {
        return response()->json([
            'message' => 'Doctor profile not found'
        ], 404);
    }
    $request->validate([
        'name' => 'sometimes|string|max:255',
        'booking_price' => 'sometimes|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = [
        'name' => $request->name ?? $doctor->name,
        'booking_price' => $request->booking_price ?? $doctor->booking_price,
        'description' => $request->description ?? $doctor->description,
        'image' => $doctor->image,
    ];

    if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('doctors', 'public');
            $data['image'] = $uploadedFile;
        }

    $doctor->update($data);

    return response()->json([
        'message' => 'Doctor information updated successfully',
        'doctor'  => $doctor
    ]);
}
    public function update_account(Request $request)
{
        AbilityHelper::authorize($request, 'doctor');
        $user = $request->user(); 
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes','email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:6|confirmed', 
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('doctors', 'public');
        }
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        return response()->json([
            'message' => 'User updated successfully',
            'doctor' => $user->only('id', 'name', 'email', 'phone', 'image'),
        ]);
}
}
