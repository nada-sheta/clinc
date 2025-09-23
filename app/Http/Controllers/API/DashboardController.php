<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AbilityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function store(CreateAccountRequest $request)
    {
        AbilityHelper::authorize($request, 'admin');
        $uploadedFile = null;
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('admins', 'public');
            $data['image'] = $uploadedFile;
        }
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $uploadedFile,
            'password'=>Hash::make($request->input('password')),
            'is_admin' => true,
            'is_user' => true,
            'is_doctor' => false,
        ]);
        return response()->json([
        'message' => 'Stored successfully!',
        'admin' => $admin
    ], 201);
    }
}
