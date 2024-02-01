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
            'text' => $request->comment['text'],
            'grade' => $request->comment['grade'],
            'restaurant_id' => $request->comment['restaurant_id'],
            'user_id' =>$request->user()->id,
        ]);

        return response()->json([
            'message' => 'Комментарий успешно отправлен'
        ], 200);
    }
}
