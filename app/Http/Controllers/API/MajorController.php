<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
       $majors= Major::get(['id', 'name', 'image']);
        return response()->json([
            'majors' => $majors
        ]);
    }
    public function show(Major $majorId)
    {
        $doctors = $majorId->doctors()
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
        'major' => [
            'id' => $majorId->id,
            'name' => $majorId->name,
            'image' => $majorId->image,
        ],
        'doctors' => $doctors
    ]);
    }
    public function store(MajorRequest $request)
    {
        AbilityHelper::authorize($request, 'admin');

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('majors', 'public');
            $data['image'] = $uploadedFile;
        }
        $major=Major::create($data);

        return response()->json([
        'message' => 'Stored successfully!',
        'major' => $major
    ], 201);
    }
    public function destroy(Request $request,Major $major)
    {
        AbilityHelper::authorize($request, 'admin');
        $major->delete();
         return response()->json([
        'message' => 'Major deleted successfully'
    ]);
    }
    public function update(MajorRequest $request, Major $major)
    {
        AbilityHelper::authorize($request, 'admin');
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('majors', 'public');
            $data['image'] = $uploadedFile;
        }
        $major->update($data);
       return response()->json([
        'message' => 'Major updated successfully',
        'major'   => $major
    ]);
    }
}
