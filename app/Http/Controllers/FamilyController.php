<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildrenStoreRequest;
use App\Http\Requests\FatherStoreRequest;
use App\Http\Requests\MotherStoreRequest;
use App\Http\Requests\SpouseStoreRequest;
use App\Models\ChildrenRecords;
use App\Models\Father;
use App\Models\Mother;
use App\Models\PersonalData;
use App\Models\SpouseRecords;

class FamilyController extends Controller
{

    public function create($cesno){

        return view('admin.201_profiling.view_profile.partials.family_profile.create_spouse', compact('cesno'));

    }

    // public function createFather($cesno){

    //     return view('admin.201_profiling.view_profile.partials.family_profile.create_father',compact('cesno'));

    // }

    // public function createMother($cesno){

    //     return view('admin.201_profiling.view_profile.partials.family_profile.create_mother', compact('cesno'));

    // }

    // public function createChildren($cesno){

    //     return view('admin.201_profiling.view_profile.partials.family_profile.create_children',compact('cesno'));

    // }


    public function storeSpouse(SpouseStoreRequest $request, $cesno){

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

        // return redirect()->back()->with(['message' => 'Spouse Created Sucessfully']);

        // return redirect()->route('haha', ['cesno' => $cesno]);

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

    public function storeFather(FatherStoreRequest $request, $cesno){

        $fatherDetails = new Father([

            'father_last_name' => $request->father_last_name,
            'father_first_name' => $request->father_first_name,
            'father_middle_name' => $request->father_middle_name,
            'father_name_extension' => $request->father_name_extension,
            'encoder' => 'sample encoder',
         
        ]);

        $fatherPersonalDataId = PersonalData::find($cesno);

        if(Father::where('personal_data_cesno', $cesno)->exists()){
            
            return "Youre Already has details in Father";

        }else{
            
            $fatherPersonalDataId->father()->save($fatherDetails);
            
        }

        return redirect()->back();

    }

    public function storeMother(MotherStoreRequest $request, $cesno){

        $motherDetails = new Mother([

            'mother_last_name' => $request->mother_last_name,
            'mother_first_name' => $request->mother_first_name,
            'mother_middle_name' => $request->mother_middle_name,
            'encoder' => 'sample encoder',
         
        ]);

        $motherPersonalDataId = PersonalData::find($cesno);

        if(Mother::where('personal_data_cesno', $cesno)->exists()){
            
            return "Youre Already has details in Mother";

        }else{
            
            $motherPersonalDataId->mother()->save($motherDetails);
            
        }

        return redirect()->back();

    }

    public function destroySpouse($ctrlno){
        
        $spouse = SpouseRecords::find($ctrlno);
        $spouse->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
