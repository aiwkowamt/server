<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     */
    public function __construct(
        private $comments,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'title' => 'Комментарии к заказам',
            'date' => date('m/d/Y'),
            'comments' => $this->comments,
        ];

        $pdf = Pdf::loadView('pdf.restaurant-comments', $data);
        $pdfContent = $pdf->output();
        Storage::put("app/public/pdfs/restaurant-comments.pdf", $pdfContent);
    }
}
