<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingSession;
use Barryvdh\DomPDF\Facade\Pdf;

class CompetencyReportController extends Controller
{
    public function generalReportIndex()
    {
        $trainingSession = TrainingSession::paginate(10);

        return view('admin.competency.reports.general_report', compact('trainingSession'));
    }

    public function generalReportGeneratePdf($sessionId)
    {
        $trainingSession = TrainingSession::find($sessionId);
        $trainingParticipantList = $trainingSession->trainingParticipantList;

        $pdf = Pdf::loadView('admin.competency.reports.general_report_pdf', compact('trainingParticipantList', 'trainingSession'))->setPaper('legal', 'landscape');
        return $pdf->stream('general-report.pdf');
    }
}
