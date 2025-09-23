<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        $data = $request->validated();
        $remember = $request->boolean('remember', false); // لو اتبعت ريميبر هتبقى ترو لو متبعتش خالص هتبقي ديفلت فلس

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $role = $user->is_admin ? 'admin' : ($user->is_doctor ? 'doctor' : 'user');
        if ($remember) {
            // توليد توكن دائم مع Sanctum
            $token = $user->createToken('clinic', [$role])->plainTextToken;
            //$new = $user->createToken(string $name, array $abilities = ['*']);
            return response()->json([
                'message' => 'Login successful',
                'user' => $user->only('id', 'name', 'email', 'phone', 'image'),
                'token' => $token,
                'role' => $role
            ]);
        } else {
            $token = $user->createToken('clinic', [$role], now()->addDay())->plainTextToken;

        return response()->json([
                'message' => 'Login successful',
                'user' => $user->only('id', 'name', 'email', 'phone', 'image'),
                'token' => $token,
                'role' => $role
        ]);
        }

    }
}