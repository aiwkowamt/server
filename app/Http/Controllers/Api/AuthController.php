<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'message' => 'Успешный вход!',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Неверная почта или пароль!',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'first_name' => $request->get('firstName'),
            'second_name' => $request->get('secondName'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'role_id' => RoleName::getId(RoleName::CUSTOMER),
        ]);

        Auth::login($user);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Успешная регистрация!'
        ], 200);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Успешный выход!'
        ], 200);
    }

    public function getUserRole()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'role' => $user->role->name,
                'message' => 'Роль пользователя найдена!',
            ]);
        }
        return response()->json(['message' => 'Не удается найти роль пользователя!'], 401);
    }
}
