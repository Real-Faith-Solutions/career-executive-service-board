<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingVenueManager;
use App\Models\ProfileLibCities;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TrainingVenueManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // search query for personal data
        $searchProfileLibCities = ProfileLibCities::query()
            ->where('name', "LIKE" ,"%$search%")
            ->orWhere('city_code',  "LIKE","%$search%")
            ->get();

        if ($search !== null) 
        {
            // Query the database to find the corresponding city
            $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

            if (!$profileLibCitiesSearchResult) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('competency-management-sub-modules-report.trainingVenueManagerReportIndex')->with('error', 'Data not found in the database.');
            }

            $trainingVenueManager = CompetencyTrainingVenueManager::select('name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson')
            ->where('city_code', $profileLibCitiesSearchResult->city_code)
            ->paginate(5);  
        }
        else
        {
            $trainingVenueManager = CompetencyTrainingVenueManager::select('name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson')
            ->paginate(5);
        }

        return view('admin.competency.reports.training_venue_manager_report', compact('trainingVenueManager','searchProfileLibCities', 'search'));
    }

    public function generatePdf()
    {
        $trainingVenueManager = CompetencyTrainingVenueManager::get(['name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson']);
           
        $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager_report_pdf', compact('trainingVenueManager'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-venue-manager-report.pdf');
    }

    public function generatePdfByCity(Request $request)
    {
        $search = $request->input('search');

        $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

        if($profileLibCitiesSearchResult != null)
        {
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::where('city_code', $profileLibCitiesSearchResult->city_code)
            ->get(['name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson']);
        }
        else
        {
            return back()->with('error', 'Please Select City Before Proceeding to Make Report.');
        }
               
        $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager_report_pdf_city', compact('trainingVenueManagerByCity', 'search'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-venue-manager-report-by-city.pdf');
    }
}
