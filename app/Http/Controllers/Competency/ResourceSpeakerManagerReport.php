<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ResourceSpeaker;
use Barryvdh\DomPDF\Facade\Pdf;

class ResourceSpeakerManagerReport extends Controller
{
    public function index()
    {
        $resourceSpeaker = ResourceSpeaker::paginate(5);

        return view('admin.competency.reports.resource_speaker_manager_report', compact('resourceSpeaker'));
    }

    public function generateReport()
    {
        $resourceSpeaker = ResourceSpeaker::get();

        $pdf = Pdf::loadView('admin.competency.reports.resource_speaker_manager_report_pdf', compact('resourceSpeaker'))->setPaper('a4', 'landscape');
        return $pdf->stream('resource-speaker-manager-report.pdf');
    }
}
