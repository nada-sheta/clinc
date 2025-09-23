<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Models\DoctorApplication;
use App\Http\Requests\DoctorApplicationRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class DoctorRequestsController extends Controller
{
    public function show(Request $request)
    {
        AbilityHelper::authorize($request, 'admin');
        $requests = DoctorApplication::all();
        return response()->json([
        'requests'   => $requests
    ]);
    } 
    public function destroy(Request $request,DoctorApplication $id)
    {
        AbilityHelper::authorize($request, 'admin');
        $id->delete();
        return response()->json([
        'message' => 'Request deleted successfully'
    ]);
    }
    public function store(DoctorApplicationRequest $request)
    {
        $data = $request->validated();
        $file = $request->hasFile('degree_certificate');
        if($file){
            $filename = Cloudinary::upload($request->file('degree_certificate')->getRealPath())->getSecurePath();
            $data['degree_certificate'] = $filename ;
        }
        $application = DoctorApplication::create($data);

       return response()->json([
        'requests'   => $application
    ]);
  }
}
