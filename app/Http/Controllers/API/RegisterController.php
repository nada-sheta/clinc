<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
{
    $data = $request->validated();
    if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image')->store('users', 'public');
            $data['image'] = $uploadedFile;
        }
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    $token = $user->createToken('clinic', ['user'])->plainTextToken;

    return response()->json([
        'message' => 'Registration successful',
        'user' => $user,
        'token' => $token,
    ]);
}

}
