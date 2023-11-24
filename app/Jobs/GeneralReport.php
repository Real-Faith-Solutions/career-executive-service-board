<?php

namespace App\Jobs;

use App\Models\Eris\EradTblMain;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneralReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle():void
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
        ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.general_report.report_pdf', [
            'eradTblMain' => $eradTblMain,
        ])
        ->setPaper('a4', 'landscape');

        $pdf->download('eris-general-report.pdf');
    }
}
