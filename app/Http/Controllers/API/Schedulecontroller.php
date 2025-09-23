<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class Schedulecontroller extends Controller
{
    public function show(Request $request)
    {
        AbilityHelper::authorize($request, 'doctor');
        $doctor = $request->user()->doctor;
        $schedules = DoctorSchedule::where('doctor_id', $doctor->id)
           ->select('id','doctor_id', 'day_from', 'day_to', 'time_from', 'time_to', 'start_date')
           ->get();
        return response()->json([
        'schedule' => $schedules
        ]);
    }
    public function store(ScheduleRequest $request)
    {
       AbilityHelper::authorize($request, 'doctor');
        $doctor = $request->user()->doctor;
        $schedule = DoctorSchedule::create([
            'doctor_id'    => $doctor->id,
            'day_from'    => $request->day_from,
            'day_to'      => $request->day_to,
            'time_from'   => $request->time_from,
            'time_to'     => $request->time_to,
            'start_date'  => $request->start_date,
        ]);
        return response()->json([
        'schedule' => $schedule->only('id','doctor_id', 'day_from', 'day_to',
         'time_from', 'time_to', 'start_date'),
        ]);
    }
    public function destroy(Request $request,DoctorSchedule $slot)
    {
        AbilityHelper::authorize($request, 'doctor');
        $slot->delete();
        return response()->json([
        'message' => 'Doctor deleted successfully'
        ]);
    }
}
