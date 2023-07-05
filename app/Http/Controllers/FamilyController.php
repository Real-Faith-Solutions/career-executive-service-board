<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\SpouseRecords;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function create($cesno){
        return view('admin.201_profiling.view_profile.family_profile.create', compact('cesno'));
    }

    public function store(Request $request, $cesno){

        $personal_data = new SpouseRecords([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'suffix' => $request->suffix,
            'occupation' => $request->occupation,
            'employer_business_name' => $request->employer_bussiness_name,
            'employer_business_address' => $request->employer_bussiness_address,
            'employer_business_telephone' => $request->employer_bussiness_telephone,
            'encoder' => 'sample encoder',
        ]);

        $PersonalDataId = PersonalData::find($cesno);

        $PersonalDataId->spouses()->save($personal_data);

        return redirect()->back();

    }
}
