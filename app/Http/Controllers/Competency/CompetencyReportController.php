<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class CompetencyReportController extends Controller
{
    // general report
        public function generalReportIndex()
        {
            $trainingSession = TrainingSession::all();

            return view('admin.competency.reports.general_report', compact('trainingSession'));
        }

        public function generalReportGeneratePdf($sessionId)
        {
            $trainingSession = TrainingSession::find($sessionId);
            $trainingParticipantList = $trainingSession->trainingParticipantList;

            $pdf = Pdf::loadView('admin.competency.reports.general_report_pdf', compact('trainingParticipantList'))->setPaper('a4', 'landscape');
            return $pdf->stream('training-provider-manager-report.pdf');
        }
    // end of general report

    // training provider report
        public function trainingProviderIndexReport()
        {
            $competencyTrainingProvider = CompetencyTrainingProvider::get();

            return view('admin.competency.reports.training_provider_report', compact('competencyTrainingProvider'));
        }

        public function trainingProviderGenerateReport()
        {
            $competencyTrainingProvider = CompetencyTrainingProvider::get();

            $pdf = Pdf::loadView('admin.competency.reports.training_provider_report_pdf', compact('competencyTrainingProvider'))->setPaper('a4', 'landscape');
            return $pdf->stream('training-provider-manager-report.pdf');
        }
    // end of training provider report
}
