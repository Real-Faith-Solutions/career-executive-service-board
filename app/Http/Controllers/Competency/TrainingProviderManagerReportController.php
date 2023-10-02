<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TrainingProviderManagerReportController extends Controller
{
    public function index()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::select('providerID', 'provider', 'house_bldg', 'st_road', 'brgy_vill', 'city_code', 'contactno', 
        'emailadd', 'contactperson')->orderBy('providerID', 'desc')->paginate(5);

        return view('admin.competency.reports.training_provider_report', compact('competencyTrainingProvider'));
    }

    public function generatePDF()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::all(['providerID', 'provider', 'house_bldg', 'st_road', 'brgy_vill', 'city_code', 'contactno', 
        'emailadd', 'contactperson']);

        $pdf = Pdf::loadView('admin.competency.reports.training_provider_report_pdf', compact('competencyTrainingProvider'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-provider-manager-report.pdf');
    }
}
