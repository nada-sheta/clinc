<?php

namespace App\Http\Controllers\Site;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('site.pages.register');
    
    }
    public function store(RegisterRequest $request)
    {
            $data = $request->validated();
            $uploadedFile = null;
            if ($request->hasFile('image')) {
                $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $data['image'] = $uploadedFile;
            }
            $data['password'] = Hash::make($request->input('password'));
    
            $user = User::create($data);
    
            Auth::guard('web')->login($user);//بدل م يعمل لوج ان بعد م يكريت اكونت يدخله ع طول علي الموقع
    
            return redirect()->route('site.home');
    }
}
