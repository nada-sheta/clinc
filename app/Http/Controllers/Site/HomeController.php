<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Major;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors= Major::get();
        $doctors = Doctor::with('major')
        ->withAvg('ratings', 'rating') // اسم العمود هو rating زي ما في الموديل
        ->get();
        // $doctors = Doctor::with('major')->get();
        //دا اسم الميثود اللي جوا موديل الدكتور major
        return view('site.pages.home',compact('majors','doctors'));
    }
}
