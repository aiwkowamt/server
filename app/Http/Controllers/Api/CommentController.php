<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'text' => $request->input('text'),
            'grade' => $request->input('grade'),
            'user_id' => $request->user()->id,
        ]);

        $order = Order::find($request->input('order_id'));
        $order->comment_id = $comment->id;
        $order->save();

        return response()->json([
            'message' => 'Комментарий успешно отправлен'
        ], 200);
    }
}
