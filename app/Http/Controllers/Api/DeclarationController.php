<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Declaration;
use Illuminate\Http\Request;
use App\Enums\DeclarationStatus;

class DeclarationController extends Controller
{
    public function store(Request $request)
    {
        $declaration = Declaration::create([
            'user_id' => $request->user()->id,
            'description' => $request->input('description'),
            'status' => DeclarationStatus::PENDING,
        ]);

        if ($declaration) {
            return response()->json([
                'message' => 'Декларация успешно создана!',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Не удалось создать декларацию',
            ], 500);
        }
    }

    public function checkDeclarationStatus(Request $request)
    {
        $user_id = $request->user()->id;
        $declaration = Declaration::where('user_id', $user_id)->first();

        if ($declaration) {
            $status = $declaration->status;
        } else {
            $status = null;
        }

        return response()->json([
            'status' => $status,
        ], 200);
    }
}
