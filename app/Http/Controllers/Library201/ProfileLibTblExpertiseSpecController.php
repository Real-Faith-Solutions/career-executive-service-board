<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ProfileLibTblExpertiseMaster;
use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
        
        return view('admin.201_library.expertise_specialization.create', [
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblExpertiseSpec,Title'],
        ]);

        ProfileLibTblExpertiseSpec::create($request->all());

        $specializationCode = ProfileLibTblExpertiseSpec::latest()->value('SpeExp_Code');

        ProfileLibTblExpertiseMaster::create([
            'SpeExp_CODE' => $specializationCode,
            'GenExp_CODE' => $request->expertise_general,
        ]);

        return to_route('expertise-specialization.index')->with('message', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::find($code);

        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();

        $profileLibTblExpertiseMaster = ProfileLibTblExpertiseMaster::where('SpeExp_CODE', $code)->value('GenExp_CODE');

        return view('admin.201_library.expertise_specialization.edit', [
            'code' => $code,
            'profileLibTblExpertiseSpec' => $profileLibTblExpertiseSpec,
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
            'profileLibTblExpertiseMaster' => $profileLibTblExpertiseMaster,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblExpertiseSpec')->ignore($code, 'SpeExp_Code')],
        ]);

        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::find($code);
        $profileLibTblExpertiseSpec->update($request->all());

        $expertiseMasterCode = ProfileLibTblExpertiseMaster::where('SpeExp_CODE', $code)->value('RECNUM');

        $profileLibTblExpertiseMaster = ProfileLibTblExpertiseMaster::find($expertiseMasterCode);
        $profileLibTblExpertiseMaster->GenExp_CODE = $request->expertise_general;
        $profileLibTblExpertiseMaster->update();

        return to_route('expertise-specialization.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::find($code);
        $profileLibTblExpertiseSpec->delete();

        return back()->with('message', 'Data Deleted Successfully');
    }
}
