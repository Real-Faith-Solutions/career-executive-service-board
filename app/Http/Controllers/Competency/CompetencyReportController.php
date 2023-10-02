<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use App\Models\CompetencyTrainingVenueManager;
use App\Models\ProfileLibCities;
use App\Models\ResourceSpeaker;
use App\Models\TrainingSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CompetencyReportController extends Controller
{
    // general report
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
    // end of general report

    // training venue manager report
    public function trainingVenueManagerReportIndex(Request $request)
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

    public function trainingVenueManagerReportGeneratePdf()
    {
        $trainingVenueManager = CompetencyTrainingVenueManager::get(['name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson']);
           
        $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager_report_pdf', compact('trainingVenueManager'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-venue-manager-report.pdf');
    }

    public function trainingVenueManagerReportGeneratePdfByCity(Request $request)
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
    // end of training venue manager report

    // training provider report
    public function trainingProviderIndexReport()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::select('providerID', 'provider', 'house_bldg', 'st_road', 'brgy_vill', 'city_code', 'contactno', 
        'emailadd', 'contactperson')->orderBy('providerID', 'desc')->paginate(5);

        return view('admin.competency.reports.training_provider_report', compact('competencyTrainingProvider'));
    }

    public function trainingProviderGenerateReport()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::all(['providerID', 'provider', 'house_bldg', 'st_road', 'brgy_vill', 'city_code', 'contactno', 
        'emailadd', 'contactperson']);

        $pdf = Pdf::loadView('admin.competency.reports.training_provider_report_pdf', compact('competencyTrainingProvider'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-provider-manager-report.pdf');
    }
    // end of training provider report

    // resource speaker manager report
    public function resourceSpeakerIndexReport()
    {
        $resourceSpeaker = ResourceSpeaker::paginate(10);

        return view('admin.competency.reports.resource_speaker_manager_report', compact('resourceSpeaker'));
    }

    public function resourceSpeakerGenerateReport()
    {
        $resourceSpeaker = ResourceSpeaker::get();

        $pdf = Pdf::loadView('admin.competency.reports.resource_speaker_manager_report_pdf', compact('resourceSpeaker'))->setPaper('a4', 'landscape');
        return $pdf->stream('resource-speaker-manager-report.pdf');
    }
    //end of resource speaker manager report

}
