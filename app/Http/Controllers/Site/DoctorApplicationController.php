<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorApplicationRequest;
use Illuminate\Http\Request;
use App\Models\DoctorApplication;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DoctorApplicationController extends Controller
{
    public function show()
    {
        return view("site.pages.doctor_application");
    }
    public function store(DoctorApplicationRequest $request)
    {


        $data = $request->validated();
        $file = $request->hasFile('degree_certificate');
        if($file){
            $filename = Cloudinary::upload($request->file('degree_certificate')->getRealPath())->getSecurePath();
            $data['degree_certificate'] = $filename ;
        }
        DoctorApplication::create($data);

        return redirect()->back()->with('success', 'Stored successfully!');
    }
}
