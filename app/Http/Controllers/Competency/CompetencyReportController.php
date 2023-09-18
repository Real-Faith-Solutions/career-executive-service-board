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
            $cityCode = $request->input('city_code');
          
            if($cityCode == null)
            {
                $trainingVenueManager = CompetencyTrainingVenueManager::paginate(10);
            }
            else
            {    
                $trainingVenueManager = CompetencyTrainingVenueManager::where('city_code', $cityCode)->paginate(10);
            }

            $profileLibTblCities = ProfileLibCities::all();

            return view('admin.competency.reports.training_venue_manager_report', compact('trainingVenueManager', 'profileLibTblCities', 'cityCode'));
        }

        public function trainingVenueManagerReportGeneratePdf()
        {
            $trainingVenueManager = CompetencyTrainingVenueManager::get();
           
            $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager_report_pdf', compact('trainingVenueManager'))->setPaper('legal', 'landscape');
            return $pdf->stream('training-venue-manager-report.pdf');
        }
    // end of training venue manager report

    // training provider report
        public function trainingProviderIndexReport()
        {
            $competencyTrainingProvider = CompetencyTrainingProvider::paginate(10);

            return view('admin.competency.reports.training_provider_report', compact('competencyTrainingProvider'));
        }

        public function trainingProviderGenerateReport()
        {
            $competencyTrainingProvider = CompetencyTrainingProvider::get();

            $pdf = Pdf::loadView('admin.competency.reports.training_provider_report_pdf', compact('competencyTrainingProvider'))->setPaper('legal', 'landscape');
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

            $pdf = Pdf::loadView('admin.competency.reports.resource_speaker_manager_report_pdf', compact('resourceSpeaker'))->setPaper('legal', 'landscape');
            return $pdf->stream('resource-speaker-manager-report.pdf');
        }
    //end of resource speaker manager report

}
