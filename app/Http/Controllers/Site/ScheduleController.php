<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\DoctorSchedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function show($doctorId)
    {
        $doctor = Doctor::where('account_doctor', $doctorId)->firstOrFail();
        $schedules = DoctorSchedule::where('doctor_id', $doctor->id)->get();
        return view('site.pages.schedule',compact('doctorId','schedules'));
    }
    public function store(ScheduleRequest $request,$doctorId)
    {
       $doctor = Doctor::where('account_doctor', $doctorId)->firstOrFail();
       DoctorSchedule::create([
            'doctor_id'    => $doctor->id,
            'day_from'    => $request->day_from,
            'day_to'      => $request->day_to,
            'time_from'   => $request->time_from,
            'time_to'     => $request->time_to,
            'start_date'  => $request->start_date,
        ]);
        return redirect()->back()->with('success', 'Appointments added successfully');
    }
    public function destroy(DoctorSchedule $slot)
    {
        $slot->delete();
        return redirect()->back();
    }
}
