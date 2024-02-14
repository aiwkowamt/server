<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\GeneratePDFRestaurantComments;
use App\Models\Comment;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function generatePDFComments($id)
    {
        $orders = Order::where('restaurant_id', $id)->get();
        $comments = [];
        foreach ($orders as $order) {
            $comment = Comment::with('user')->find($order->comment_id);
            if ($comment) {
                $comments[] = [
                    'grade' => $comment->grade,
                    'text' => $comment->text,
                    'email' => $comment->user->email,
                ];
            }
        }

        GeneratePDFRestaurantComments::dispatch($comments);

        return response()->json([
            'message' => 'PDF start generation',
        ]);
    }
}
