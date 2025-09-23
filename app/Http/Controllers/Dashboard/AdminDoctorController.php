<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Major;
use App\Http\Requests\DoctorRequest;
use App\Models\DoctorApplication;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('major')->get();
        return view("dashboard.pages.doctors",compact('doctors'));
    }     
    public function create($id = null)
    {
        if ($id) {
        // هنا الكود اللي هيستخدم الـ id، مثلاً جيب داتا الدكتور
        $doctor = DoctorApplication::find($id);
        // أي لوجيك تاني
        } else {
        // لو مفيش id، نفّذ اللوجيك العادي
        $doctor = null; // أو أي قيمة افتراضية
    }
        $majors = Major::all();
        return view("dashboard.pages.create_doctor", compact('majors','doctor'));
    }
    public function store(DoctorRequest $request,$id = null)
    {
        $data = $request->validated();
        $uploadedFile = null;
        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $uploadedFile;
        }

        $user = User::create([
            'name' => $request->name,
            'image' => $uploadedFile,
            'email' => $request->email,
            'password'=>Hash::make($request->input('password')),
            'is_admin' => false,
            'is_user' => false,
            'is_doctor' => true,
        ]);

        Doctor::create([
        'name'          => $request->name,
        'description'   => $request->description,
        'booking_price' => $request->booking_price,
        'image'         => $uploadedFile,
        'major_id'      => $request->major_id,
        'account_doctor'     => $user->id, // هنا الربط الحقيقي
        ]);
        if ($id) {
            return redirect()->route('dashboard.edit.mail')->with([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
                'id_doctor' => $id,
            ]);
        } else {
            return redirect()->back()->with('success', 'Doctor has been added successfully');
        }

    }
    public function destroy(Doctor $doctor)
    {
        $doctor->bookings()->delete();
        $doctor->user()->delete();
        $doctor->delete();
        return redirect()->back();
    }
    public function edit(Doctor $doctor)
    {
         $majors = Major::all();
        return view('dashboard.pages.edit_doctor',compact('majors','doctor'));
    }
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();
        $file = $request->hasFile('image');
        if($file){
            $filename = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $filename ;
        }
        $doctor->update($data);
        return redirect()->route('dashboard.doctors')->with('success', 'Update completed');
    }

}
