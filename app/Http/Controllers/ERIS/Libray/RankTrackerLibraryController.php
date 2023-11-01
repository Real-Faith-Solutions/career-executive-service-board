<?php

namespace App\Http\Controllers\ERIS\Libray;

use App\Http\Controllers\Controller;
use App\Models\Eris\LibraryRankTracker;
use App\Models\Eris\RankTracker;
use Illuminate\Http\Request;

class RankTrackerLibraryController extends Controller
{
    public function index()
    {
        $libraryRankTracker = LibraryRankTracker::orderBy('description')
        ->paginate(25);

        return view('admin.eris_library.rank_tracker.index', [
            'libraryRankTracker' => $libraryRankTracker,
        ]);
    }

    public function create()
    {
        return view('admin.eris_library.rank_tracker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'unique:erad_libRankTracker,description'],
        ]);
        
        LibraryRankTracker::create($request->all());
        
        return to_route('rank-tracker-library.index')->with('message', 'Save Successfully');
    }
}
