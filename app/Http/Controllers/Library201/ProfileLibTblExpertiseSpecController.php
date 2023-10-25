<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function GuzzleHttp\Promise\all;

class ProfileLibTblExpertiseSpecController extends Controller
{
    public function index()
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::paginate(25);
        
        return view('admin.201_library.expertise_specialization.index', [
            'profileLibTblExpertiseSpec' => $profileLibTblExpertiseSpec,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.expertise_specialization.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblExpertiseSpec,Title'],
        ]);

        ProfileLibTblExpertiseSpec::create($request->all());

        return to_route('expertise-specialization.index')->with('messages', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::find($code);

        return view('admin.201_library.expertise_specialization.edit', [
            'code' => $code,
            'profileLibTblExpertiseSpec' => $profileLibTblExpertiseSpec,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblExpertiseSpec')->ignore($code, 'SpeExp_Code')],
        ]);

        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::find($code);
        $profileLibTblExpertiseSpec->update($request->all());

        return to_route('expertise-specialization.index')->with('message', 'Data Update Successfully');
    }
}
