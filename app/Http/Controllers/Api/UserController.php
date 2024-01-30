<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserAddress(Request $request)
    {
        $address = $request->user()->address;
        return response()->json([
            'address' => $address,
        ]);
    }
}
