<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ResourceSpeaker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class ResourceSpeakerManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('expertise');

        $expertise = ResourceSpeaker::distinct()->get(['expertise']);

        if($search == null || $search == 'all')
        {
            $resourceSpeaker = ResourceSpeaker::paginate(25);
        }
        else
        {
            $resourceSpeaker = ResourceSpeaker::where('expertise', $search)->paginate(25);
        }
    
        return view('admin.competency.reports.resource_speaker_manager.report', compact('resourceSpeaker', 'expertise', 'search'));
    }

    public function generateReport(Request $request)
    {
        $expertise = $request->input('expertise');

        if($expertise == 'all')
        {
            $resourceSpeaker = ResourceSpeaker::get();
        }
        else
        {
            $resourceSpeaker = ResourceSpeaker::where('expertise', $expertise)->get();
        }
   
        $pdf = Pdf::loadView('admin.competency.reports.resource_speaker_manager.report_pdf', compact('resourceSpeaker'))->setPaper('a4', 'landscape');
        return $pdf->stream('resource-speaker-manager-report.pdf');
    }
}
