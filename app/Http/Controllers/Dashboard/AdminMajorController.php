<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminMajorController extends Controller
{
    public function index()
    {
       $majors= Major::get();
        return view("dashboard.pages.majors",compact('majors'));
    }
    public function show(Major $majorId)
    {
        $doctors = $majorId->doctors; 
        return view('dashboard.pages.doctors', compact('doctors'));
    }
    public function create()
    {
        return view("dashboard.pages.create_major");
    }  
    public function store(MajorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $uploadedFile;
        }
        Major::create($data);

        return redirect()->back()->with('success', 'Stored successfully!');
    }
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->back();
    }
    public function edit(Major $major)
    {
        return view('dashboard.pages.edit_major',compact('major'));
    }
    public function update(MajorRequest $request, Major $major)
    {
        $data = $request->validated();
        $file = $request->hasFile('image');
        if($file){
            $filename = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $data['image'] = $filename ;
        }
        $major->update($data);
        return redirect()->route('dashboard.majors')->with('success', 'Update completed');
    }
    public function searchMajors(Request $request)
    {
        $query = $request->input('query');

        // ✅ لو المستخدم مدخلش أي حاجة، مترجّعش دكاترة
        if ($query === '') {
            return response()->json(['majors' => []]);
        }

        $majors = Major::where('name', 'LIKE', "%{$query}%")->get();

        // نحول الداتا عشان تبقى جاهزة للـ JS
        $majors->transform(function($major){
            return [
                'id' => $major->id,
                'name' => $major->name,
                'image' => FileHelper::major_image($major->image),
            ];
        });

        return response()->json([
            'majors' => $majors
        ]);
    }
}
