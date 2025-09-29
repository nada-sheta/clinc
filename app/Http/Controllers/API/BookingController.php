<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
     public function show(Request $request, Doctor $doctor)
    {
        AbilityHelper::authorize($request, 'user');
        $doctor = $doctor->load(['ratings.user', 'schedule']);

        $daysOfWeek = [
            "sunday", "monday", "tuesday", "wednesday",
            "thursday", "friday", "saturday"
        ];

        $schedules = [];
        foreach ($doctor->schedule as $sch) {
            // هات index البداية والنهاية
            $startIndex = array_search(strtolower($sch->day_from), $daysOfWeek);
            $endIndex   = array_search(strtolower($sch->day_to), $daysOfWeek);

            // لو الـ end قبل start (يعني مثلا من الجمعة للاتنين) نلف الأسبوع
            if ($endIndex < $startIndex) {
                $endIndex += 7;
            }

            // عدّي على كل يوم بين start و end
            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $day = $daysOfWeek[$i % 7];

                // ساعات من time_from → time_to
                $availableHours = [];
                $startHour = (int)date('H', strtotime($sch->time_from));
                $endHour   = (int)date('H', strtotime($sch->time_to));

                for ($h = $startHour; $h <= $endHour; $h++) {
                    $availableHours[] = sprintf("%02d:00", $h);
                }

                $schedules[] = [
                    'schedule_id'    => $sch->id,
                    'day'            => $day,
                    'available_hours'=> $availableHours
                ];
            }
        }

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
                            'name' => $rating->user->name,
                        ]
                    ];
                }),
                'schedules' => $schedules
            ]
        ]);
    }
    public function store(BookingRequest $request, $doctorId)
    {
        $user = AbilityHelper::authorize($request, 'user');
        [$dayscheduleId, $dayName] = explode('_', $request->day); 
        [$timeScheduleId, $hour] = explode('-', $request->time);
         if ($dayscheduleId != $timeScheduleId) {
             return response()->json([ 'status' => 'error', 'message' => 'Selected time does not match the selected day.' ], 422);
             }
         $dayMap = [ 
            'saturday' => 6,
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5
         ];
         $dayNumber = $dayMap[strtolower($dayName)];
         $doctorSchedule = DoctorSchedule::findOrFail($dayscheduleId);
         $startDate = Carbon::parse($doctorSchedule->start_date);
         $bookingDate = Carbon::parse($startDate)->next($dayNumber)
          ->setHour($hour)
          ->setMinute(0)
          ->setSecond(0);
           if ($bookingDate->lt(Carbon::now())) {
             $bookingDate->addWeek(); 
            }
         $alreadyBooked = Booking::where('doctor_id', $doctorId)
          ->where('booking_date', $bookingDate)
          ->exists();
         if ($alreadyBooked) {
             return response()->json([ 'status' => 'error', 'message' => 'This appointment is already booked, please choose another appointment.' ], 422);
             }
         $booking = Booking::create([
             'name' => $request->name,
             'phone' => $request->phone,
             'booking_date' => $bookingDate,
             'doctor_id' => $doctorId,
             'user_id' => $user->id,
             'email'=> $user->email

             ]);
             return response()->json([
             'status' => 'success',
             'message' => 'Booking confirmed successfully!',
             'booking' => $booking
             ]);
     }

     public function destroyFromUser(Request $request,Booking $booking)
    {
        $user = AbilityHelper::authorize($request, 'user');
        $booking->delete();
        return response()->json([
        'message' => 'Booking deleted successfully'
        ]);
    }

    public function destroyFromDoctor(Request $request,Booking $booking)
    {
        AbilityHelper::authorize($request, 'doctor');
        $booking->delete();
        return response()->json([
        'message' => 'Booking deleted successfully'
        ]);
    }
}
