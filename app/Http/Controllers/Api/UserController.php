<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('role');
        if($user){
            return response()->json([
                'user' => $user,
            ]);
        } else {
            return  response()->json([
                'message' => 'Не авторизован',
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['phone', 'address']));

        return response()->json(['message' => 'Пользователь обновлен']);
    }

}
