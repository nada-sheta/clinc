<?php

namespace App\Http\Controllers\Site;

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
    // public function show($majorId)
    // {
    //    $doctors=Doctor::where('major_id', $majorId)->with('major')->get();
    //     return view("site.pages.doctor", compact('doctors'));
    // }
    public function show(Major $majorId)
    {
        $doctors = $majorId->doctors()
        ->withAvg('ratings', 'rating') // يحسب متوسط التقييم
        ->get();
        return view('site.pages.doctor', compact('doctors'));
    }
}
