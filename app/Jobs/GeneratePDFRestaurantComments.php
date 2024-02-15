<?php

namespace App\Jobs;

use App\Events\PDFGeneration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GeneratePDFRestaurantComments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private $comments,
    )
    {}

    public function handle(): void
    {
        $data = [
            'title' => 'Комментарии к заказам',
            'date' => date('m/d/Y'),
            'comments' => $this->comments,
        ];

        $pdf = Pdf::loadView('pdf.restaurant-comments', $data);
        $fileName = 'restaurant-comments.pdf';
        $filePath = 'public/pdfs/';
        $file = Storage::disk('local')->put($filePath . $fileName, $pdf->output());
        $fileUrl = Storage::path($filePath);
        chmod($fileUrl, 0777);
        $fileUrl = $filePath . $fileName;

        event(new PDFGeneration($fileUrl));
    }
}
