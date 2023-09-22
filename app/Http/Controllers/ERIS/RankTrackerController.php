<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class RankTrackerController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $rankTracker = $erisTblMain->rankTracker()->paginate(20);

        return view('admin.eris.partials.rank_tracker.table', compact('acno', 'rankTracker'));
    }
}
