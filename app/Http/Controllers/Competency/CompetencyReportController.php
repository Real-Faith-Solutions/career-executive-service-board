<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
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
