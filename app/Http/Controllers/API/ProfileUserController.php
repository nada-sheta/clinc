<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileUserController extends Controller
{
    public function profile_user(Request $request)
    {
        if ($request->user()->tokenCan('user')) {
            $user = $request->user();

        $bookings = Booking::with('doctor')
            ->where('user_id', $user->id)
            ->get()->map(function ($booking) {
            return [
                'id'               => $booking->id,
                'name of booking'  => $booking->name,
                'phone'            => $booking->phone,
                'date'             => $booking->booking_date,
                'doctor' => $booking->doctor ? [
                    'doctor name'          => $booking->doctor->name,
                    'image'         => $booking->doctor->image,
                    'booking price' => $booking->doctor->booking_price,
                ] : null
            ];
        });

            return response()->json([
                'user'   => $user->only('id', 'name', 'email', 'phone', 'image'),
                'bookings' => $bookings
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
    }
    public function update(Request $request)
    {
        AbilityHelper::authorize($request, 'user');
        $user = $request->user(); 
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes','email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:6|confirmed', 
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('users', 'public');
        }
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user->only('id', 'name', 'email', 'phone', 'image'),
        ]);
    }
}
