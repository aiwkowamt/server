<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'text' => $request->input('text'),
            'grade' => $request->input('grade'),
            'order_id' => $request->input('order_id'),
            'user_id' =>$request->user()->id,
        ]);

        return response()->json([
            'message' => 'Комментарий успешно отправлен'
        ], 200);
    }
}
