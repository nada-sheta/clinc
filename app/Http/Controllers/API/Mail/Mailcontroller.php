<?php

namespace App\Http\Controllers\Api\Mail;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\AcceptMail;
use Illuminate\Support\Facades\Mail;
use App\Models\DoctorApplication;

class Mailcontroller extends Controller
{
    public function send_accept(Request $request, $id = null)
    {
        AbilityHelper::authorize($request, 'admin');
        ini_set('max_execution_time', 120);
        $data = $request->only(['name', 'email', 'password', 'message', 'footer']);
            $doctor_id = DoctorApplication::findOrFail($id);
            $recipientEmail = $doctor_id->email;

        Mail::to($recipientEmail)->send(new AcceptMail($data));
        
        return response()->json([
        'message' => 'Accept email sent successfully.',]);
    }

}
