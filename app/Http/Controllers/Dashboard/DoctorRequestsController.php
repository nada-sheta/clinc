<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DoctorApplication;
use Illuminate\Http\Request;

class DoctorRequestsController extends Controller
{
    public function show()
    {
        $requests = DoctorApplication::all();
        return view("dashboard.pages.doctor_requests",compact('requests'));
    } 
}
