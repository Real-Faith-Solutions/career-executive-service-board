<?php

namespace App\Http\Controllers\ERIS\Libray;

use App\Http\Controllers\Controller;
use App\Models\Eris\LibraryRankTracker;
use App\Models\Eris\RankTracker;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function edit($code)
    {
        $libraryRankTracker = LibraryRankTracker::find($code);

        return view('admin.eris_library.rank_tracker.edit', [
            'code' => $code,
            'libraryRankTracker' => $libraryRankTracker,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'description' => ['required', Rule::unique('erad_libRankTracker')->ignore($code, 'ctrlno')],
        ]);

        $ibraryRankTracker = LibraryRankTracker::find($code);
        $ibraryRankTracker->update($request->all());

        return to_route('rank-tracker-library.index')->with('message', 'Data Update Successfully');
    }
}
