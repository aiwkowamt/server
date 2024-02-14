<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Jobs\SendSuccessfulEmail;
use App\Mail\SuccessfulRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Неверная почта или пароль',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'role_id' => RoleName::getId(RoleName::CUSTOMER),
        ]);

        SendSuccessfulEmail::dispatch($user);

        Auth::login($user);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Успешный выход'
        ], 200);
    }
}
