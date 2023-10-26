<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileLibTblExpertiseGenController extends Controller
{
    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }
    
    public function index()
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::paginate(25);

        return view('admin.201_library.expertise_general.index', [
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.expertise_general.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblExpertiseGen,Title'],
        ]);

        ProfileLibTblExpertiseGen::create(array_merge(
            $request->all(), 
            [
                'encoder' => $this->getFullNameAttribute(),
            ]
        ));

        return to_route('expertise-general.index')->with('message', 'Save Successfully');
    }
}
