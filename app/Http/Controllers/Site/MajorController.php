<?php

namespace App\Http\Controllers\Site;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Doctor;

class MajorController extends Controller
{
    
    public function index()
    {
       $majors= Major::get();
        return view("site.pages.major",compact('majors'));
    }
    public function show(Major $majorId)
    {
        $doctors = $majorId->doctors()
        ->withAvg('ratings', 'rating') // يحسب متوسط التقييم
        ->get();
        return view('site.pages.doctor', compact('doctors'));
    }
    public function searchMajors(Request $request)
    {
        $query = $request->input('query');

        $majors = Major::where('name', 'LIKE', "%{$query}%")->get();

        // نحول الداتا عشان تبقى جاهزة للـ JS
        $majors->transform(function($major){
            return [
                'id' => $major->id,
                'name' => $major->name,
                'image' => FileHelper::major_image($major->image)
            ];
        });

        return response()->json([
            'majors' => $majors
        ]);
    }
}
