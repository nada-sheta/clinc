<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BookingRequest;
use Illuminate\Auth\Events\Validated;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('major')
        ->withAvg('ratings', 'rating') 
        ->get();
        return view("site.pages.doctor",compact('doctors'));
    }

    public function show($doctorId)
    {
        $doctor = Doctor::with(['ratings.user'])->findOrFail($doctorId);
        $daysOfWeek = [
            "sunday", "monday", "tuesday", "wednesday",
            "thursday", "friday", "saturday"
        ];

        $schedules = [];
        foreach ($doctor->schedule as $sch) {
            $startIndex = array_search(strtolower($sch->day_from), $daysOfWeek);
            $endIndex   = array_search(strtolower($sch->day_to), $daysOfWeek);

            if ($endIndex < $startIndex) {
                $endIndex += 7;
            }

            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $day = $daysOfWeek[$i % 7];

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
            }}
        return view('site.pages.booking', compact('doctor', 'schedules'));
    }
    
    public function store(BookingRequest $request,$doctorId)
    {
        [$dayscheduleId, $dayName] = explode('_', $request->day);
        [$timeScheduleId, $hour] = explode('-', $request->time);
        if ($dayscheduleId != $timeScheduleId) // ال id بتاع جدول مواعيد الدكتور           
         {
        return back()->withErrors(['time' => 'Selected time does not match the selected day.']);}
        $dayMap = [
                    'saturday' => 6,
                    'sunday' => 0,
                    'monday' => 1,
                    'tuesday' => 2,
                    'wednesday' => 3,
                    'thursday' => 4,
                    'friday' => 5,
                ];
                //dayMap دي خريطة تربط اسم اليوم برقم اليوم في الأسبوع حسب Carbon و PHP.
                $dayNumber = $dayMap[strtolower($dayName)];
                //نتأكد أن الاسم كله صغير (لأننا في بعض الأحيان بنستقبل Monday بدل monday).
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
                    return back()->withErrors(['day' => 'This appointment is already booked, please choose another appointment.']);
                }
                Booking::create([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'booking_date' => $bookingDate,
                            'doctor_id'    => $doctorId,
                            'user_id' => auth()->id(),
                            'email'=> auth()->user()->email                          
                        ]);

       if (Gate::allows('is-user')) {
            return redirect()->route('profile.user');
        } elseif (Gate::allows('is-doctor')) {
            return redirect()->route('profile.doctor');
        } else {
            return redirect()->route('login.show');
        }
    }

    public function show_rate($doctorId)//ميثود اليوزر لما يعمل ريت
    {
        $doctor = Doctor::findOrFail($doctorId); 
        return view("site.pages.rating",compact('doctor'));
    }
    
    public function store_rate(Request $request, $doctorId)//ميثود حفظ الريت اللي ليوزر عمله
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Rating::create([
            'doctor_id' => $doctorId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('profile.user')->with('success', 'Rating submitted successfully.');
    }


}
