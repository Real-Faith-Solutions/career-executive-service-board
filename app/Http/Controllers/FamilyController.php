<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildrenStoreRequest;
use App\Http\Requests\FatherStoreRequest;
use App\Http\Requests\MotherStoreRequest;
use App\Http\Requests\SpouseStoreRequest;
use App\Models\ChildrenRecords;
use App\Models\Father;
use App\Models\Mother;
use App\Models\NameExtension;
use App\Models\PersonalData;
use App\Models\SpouseRecords;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{

    public function storeSpouse(SpouseStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name; 
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $personalData = new SpouseRecords([

            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'name_extension' => $request->name_extension,
            'occupation' => $request->occupation,
            'employer_business_name' => $request->employer_bussiness_name,
            'employer_business_address' => $request->employer_bussiness_address,
            'employer_business_telephone' => $request->employer_bussiness_telephone,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
            
        ]);

        $PersonalDataId = PersonalData::find($cesno);

        $PersonalDataId->spouses()->save($personalData);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function editSpouse($ctrlno){

        $spouseRecord = SpouseRecords::find($ctrlno);
        $nameExtensions = NameExtension::all();
        return view('admin.201_profiling.view_profile.partials.family_profile.edit_spouse', compact('nameExtensions', 'spouseRecord'));

    }

    public function updateSpouseRecord(SpouseStoreRequest $request, $ctrlno){

        $spouseRecord = SpouseRecords::find($ctrlno);
        $spouseRecord->last_name = $request->last_name;
        $spouseRecord->first_name = $request->first_name;
        $spouseRecord->middle_name = $request->middle_name;
        $spouseRecord->name_extension = $request->name_extension;
        $spouseRecord->occupation = $request->occupation;
        $spouseRecord->employer_business_name = $request->employer_bussiness_name;
        $spouseRecord->employer_business_address = $request->employer_bussiness_address;
        $spouseRecord->employer_business_telephone = $request->employer_bussiness_telephone;
        $spouseRecord->save();

        return redirect()->back()->with('message', 'Updated Successfuly');

    }

    public function destroySpouse($ctrlno){
        
        $spouse = SpouseRecords::find($ctrlno);
        $spouse->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function storeChildren(ChildrenStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name; 
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $childrenRecord = new ChildrenRecords([

            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'name_extension' => $request->name_extension,
            'birthdate' => $request->birthdate,
            'birth_place' => $request->birth_place,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $ChildrenPersonalDataId = PersonalData::find($cesno);

        $ChildrenPersonalDataId->childrens()->save($childrenRecord);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function editChildren($ctrlno){

        $nameExtensions = NameExtension::all();
        $childrenRecords = ChildrenRecords::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.family_profile.edit_children', compact('nameExtensions', 'childrenRecords'));

    }

    public function updateChildrenRecord(ChildrenStoreRequest $request, $ctrlno){

        $childrenRecord = ChildrenRecords::find($ctrlno);
        $childrenRecord->last_name = $request->last_name;
        $childrenRecord->first_name = $request->first_name;
        $childrenRecord->middle_name = $request->middle_name;
        $childrenRecord->name_extension = $request->name_extension;
        $childrenRecord->birthdate = $request->birthdate;
        $childrenRecord->birth_place = $request->birth_place;
        $childrenRecord->save();

        return redirect()->back()->with('message', 'Updated Successfuly');

    }

    public function destroyChildren($ctrlno){
        
        $children = ChildrenRecords::find($ctrlno);
        $children->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function storeFather(FatherStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name; 
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $fatherDetails = new Father([

            'father_last_name' => $request->father_last_name,
            'father_first_name' => $request->father_first_name,
            'father_middle_name' => $request->father_middle_name,
            'name_extension' => $request->father_name_extension,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $fatherPersonalDataId = PersonalData::find($cesno);

        if(Father::where('personal_data_cesno', $cesno)->exists()){
            
            return redirect()->back()->with('error', 'Already Have Details');

        }else{
            
            $fatherPersonalDataId->father()->save($fatherDetails);
            
        }

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function editFather($ctrlno){

        $nameExtensions = NameExtension::all();
        $father = Father::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.family_profile.edit_father', compact('nameExtensions', 'father'));

    }

    public function updateFatherRecord(FatherStoreRequest $request, $ctrlno){

        $father = Father::find($ctrlno);
        $father->father_last_name = $request->father_last_name;
        $father->father_first_name = $request->father_first_name;
        $father->father_middle_name = $request->father_middle_name;
        $father->name_extension = $request->father_name_extension;
        $father->save();

        return redirect()->back()->with('message', 'Updated Successfuly');

    }

    public function destroyFather($ctrlno){
        
        $father = Father::find($ctrlno);
        $father->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function storeMother(MotherStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name; 
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $motherDetails = new Mother([

            'mother_last_name' => $request->mother_last_name,
            'mother_first_name' => $request->mother_first_name,
            'mother_middle_name' => $request->mother_middle_name,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $motherPersonalDataId = PersonalData::find($cesno);

        if(Mother::where('personal_data_cesno', $cesno)->exists()){
            
            return redirect()->back()->with('error', 'Already Have Details');

        }else{
            
            $motherPersonalDataId->mother()->save($motherDetails); 
            
        }

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function editMother($ctrlno){

        $mother = Mother::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.family_profile.edit_mother', compact('mother'));

    }

    public function updateMotherRecord(MotherStoreRequest $request, $ctrlno){

        $mother = Mother::find($ctrlno);
        $mother->mother_last_name = $request->mother_last_name;
        $mother->mother_first_name = $request->mother_first_name;
        $mother->mother_middle_name = $request->mother_middle_name;
        $mother->save();

        return redirect()->back()->with('message', 'Updated Successfuly');

    }

    public function destroyMother($ctrlno){
        
        $mother = Mother::find($ctrlno);
        $mother->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

}
