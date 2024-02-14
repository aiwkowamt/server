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
    public function generatePDFComments(Request $request)
    {
        $restaurant_id = $request->input('restaurant_id');

        $orders = Order::where('restaurant_id', $restaurant_id)->get();
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

        $data = [
            'title' => 'Комментарии к заказам',
            'date' => date('m/d/Y'),
            'comments' => $comments,
        ];

        $pdf = Pdf::loadView('pdf.restaurant-comments', $data);
        $fileName = 'restaurant-comments.pdf';
        $filePath = 'public/pdfs/';
        $file = Storage::disk('local')->put($filePath . $fileName, $pdf->output());
        $fileUrl = Storage::path($filePath);
        chmod($fileUrl, 0777);

        $fileUrl = $filePath . $fileName;

        return response()->json([
            'message' => 'PDF generation started.',
            'file_url' => $fileUrl,
            'file_name' => $fileName,
        ]);
    }
}
