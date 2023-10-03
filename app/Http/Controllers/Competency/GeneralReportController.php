<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingSession;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneralReportController extends Controller
{
    public function index()
    {
        $trainingSession = TrainingSession::paginate(5);

        return view('admin.competency.reports.general_report', compact('trainingSession'));
    }

    public function generatePdf($sessionId)
    {
        $trainingSession = TrainingSession::find($sessionId);
        $trainingParticipantList = $trainingSession->trainingParticipantList;

        $pdf = Pdf::loadView('admin.competency.reports.general_report_pdf', compact('trainingParticipantList', 'trainingSession'))->setPaper('a4', 'landscape');
        return $pdf->stream('general-report.pdf');
    }
}
