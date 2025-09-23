<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\AcceptMail;
use App\Mail\AppointmentReminderMail;
use Illuminate\Http\Request;
use App\Models\DoctorApplication;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function edit_mail()
    {
        return view("dashboard.pages.edit_mail_accept");
    }

    public function send_accept(Request $request, $id = null)
    {
        ini_set('max_execution_time', 120);
        $data = $request->only(['name', 'email', 'password', 'message', 'footer']);
            $doctor_id = DoctorApplication::findOrFail($id);
            $recipientEmail = $doctor_id->email;

        Mail::to($recipientEmail)->queue(new AcceptMail($data));
        
        return redirect()->route('dashboard.doctors.create')->with('success', 'Email send successfully!');
    }

    public function send_reminder()
    {
        $targetStart = Carbon::now()->addDay()->startOfHour();
        $targetEnd = Carbon::now()->addDay()->endOfHour();
        Log::info('Target Start: ' . $targetStart);
        Log::info('Target End: ' . $targetEnd);

        $bookings = Booking::with('doctor')
                    ->whereBetween('booking_date', [$targetStart, $targetEnd])
                    ->get();
        Log::info('Bookings found: ' . $bookings->count());
        Log::info('Bookings: ' . json_encode($bookings));

        foreach ($bookings as $booking) {
            Mail::to($booking->email)->send(new AppointmentReminderMail($booking));
            Log::info('Reminder sent to: ' . $booking->email);
        }
    }
}
