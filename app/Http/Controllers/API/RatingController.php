<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function show(Request $request)
    {
    AbilityHelper::authorize($request, 'doctor');
    $doctor = $request->user()->doctor()->with(['ratings.user'])->firstOrFail();
    $ratings = $doctor->ratings->map(function ($rating) {
        return [
                'name' => $rating->user->name,
                'rating'  => $rating->rating,
                'comment' => $rating->comment,
        ]; 
    });

    return response()->json([
        'ratings' => $ratings
    ]);
    }
    public function destroy_rate(Request $request,Rating $rate)
    {
        AbilityHelper::authorize($request, 'doctor');
        $rate->delete();
       return response()->json([
        'message' => 'Rate deleted successfully'
        ]);
    }

    public function show_rating(Request $request,Doctor $doctor)
    {
        AbilityHelper::authorize($request, 'user');
        $doctor = $doctor->load(['ratings.user']);
        return response()->json([
            'doctor' => [
                'name'        => $doctor->name,
                'image'       => $doctor->image,
                'description' => $doctor->description,
                'ratings'     => $doctor->ratings->map(function ($rating) {
                    return [
                        'rating'  => $rating->rating,
                        'comment' => $rating->comment,
                        'user'    => [
                            'name'     => $rating->user->name,
                        ]
                    ];
                }),
            ]
        ]);
      }

    public function store_rate(Request $request,$doctor)
    {
        AbilityHelper::authorize($request, 'user');
        $user = $request->user(); 
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Rating::create([
            'doctor_id' => $doctor,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return response()->json([
        'message' => 'Rating submitted successfully.'
        ]);
    }
}
