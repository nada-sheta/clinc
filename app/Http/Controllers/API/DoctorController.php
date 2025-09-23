<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('major')
        ->withAvg('ratings', 'rating') 
        ->get()->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'image' => $doctor->image,
                    'booking_price' => $doctor->booking_price,
                    'description' => $doctor->description,
                    'ratings_avg_rating' => $doctor->ratings_avg_rating,
                    'major_name' => $doctor->major->name ?? null,
                ];
            });
        return response()->json([
            'doctors' => $doctors
        ]);
    }
    public function destroy(Request $request, Doctor $doctor)
    {
        AbilityHelper::authorize($request, 'admin');
        $doctor->bookings()->delete();
        $doctor->user()->delete();
        $doctor->delete();
        return response()->json([
        'message' => 'Doctor deleted successfully'
        ]);
    }
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        AbilityHelper::authorize($request, 'admin');
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('doctors', 'public');
            $data['image'] = $uploadedFile;
        }
        $doctor->update($data);
         return response()->json([
        'message' => 'doctor updated successfully',
        'doctor'   => $doctor
    ]);
   }
   public function store(DoctorRequest $request)
    {
        AbilityHelper::authorize($request, 'admin');
        $data = $request->validated();
        $uploadedFile = null;
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('doctors', 'public');
            $data['image'] = $uploadedFile;
        }

        $user = User::create([
            'name' => $request->name,
            'image' => $uploadedFile,
            'email' => $request->email,
            'password'=>Hash::make($request->input('password')),
            'is_admin' => false,
            'is_user' => false,
            'is_doctor' => true,
        ]);

        $doctor = Doctor::create([
        'name'          => $request->name,
        'description'   => $request->description,
        'booking_price' => $request->booking_price,
        'image'         => $uploadedFile,
        'major_id'      => $request->major_id,
        'account_doctor'     => $user->id, // هنا الربط الحقيقي
        ]);
         return response()->json([
        'message' => 'Stored successfully!',
        'doctor'   => $doctor->only('name', 'description', 'booking_price','image','major_id'),
        'user'   => $user->only('name', 'email', 'password'),
        ]);
    }
}
