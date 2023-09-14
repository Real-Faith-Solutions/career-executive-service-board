<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class CompetencyReportController extends Controller
{
    public function trainingProviderIndexReport()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::get();

        return view('admin.competency.reports.training_provider_report', compact('competencyTrainingProvider'));
    }

    public function trainingProviderGenerateReport()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::get();

        $pdf = Pdf::loadView('admin\competency\reports\training_provider_report_pdf', compact('competencyTrainingProvider'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-provider-manager-report.pdf');
    }
}
