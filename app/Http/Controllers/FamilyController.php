<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildrenStoreRequest;
use App\Http\Requests\FamilyProfileStoreRequest;
use App\Http\Requests\SpouseStoreRequest;
use App\Models\ChildrenRecords;
use App\Models\FamilyProfile;
use App\Models\PersonalData;
use App\Models\SpouseRecords;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function create($cesno){

        return view('admin.201_profiling.view_profile.family_profile.create', compact('cesno'));

    }

    public function store(SpouseStoreRequest $request, $cesno){

        $personalData = new SpouseRecords([

            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'name_extension' => $request->name_extension,
            'occupation' => $request->occupation,
            'employer_business_name' => $request->employer_bussiness_name,
            'employer_business_address' => $request->employer_bussiness_address,
            'employer_business_telephone' => $request->employer_bussiness_telephone,
            'encoder' => 'sample encoder',
            
        ]);

        $PersonalDataId = PersonalData::find($cesno);

        $PersonalDataId->spouses()->save($personalData);

        return redirect()->back();

    }

    public function storeChildren(ChildrenStoreRequest $request, $cesno){

        $childrenRecord = new ChildrenRecords([

            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'name_extension' => $request->name_extension,
            'birthdate' => $request->birthdate,
            'birth_place' => $request->birth_place,
            'encoder' => 'sample encoder',
         
        ]);

        $ChildrenPersonalDataId = PersonalData::find($cesno);

        $ChildrenPersonalDataId->childrens()->save($childrenRecord);

        return redirect()->back();

    }

    public function storeFamilyProfile(FamilyProfileStoreRequest $request, $cesno){

        $familyProfile = new FamilyProfile([

            'father_last_name' => $request->father_last_name,
            'father_first_name' => $request->father_first_name,
            'father_middle_name' => $request->father_middle_name,
            'father_name_extension' => $request->father_name_extension,
            'mother_last_name' => $request->mother_last_name,
            'mother_first_name' => $request->mother_first_name,
            'mother_middle_name' => $request->mother_middle_name,
            'encoder' => 'sample encoder',
         
        ]);

        $familyPersonalDataId = PersonalData::find($cesno);

        if(FamilyProfile::where('personal_data_cesno', $cesno)->exists()){
            
            return "Youre Already has details in Family Profile";

        }else{
            
            $familyPersonalDataId->familyProfile()->save($familyProfile);
            
        }

        $familyPersonalDataId->familyProfile()->save($familyProfile);

        return redirect()->back();

    }

}
