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
use Illuminate\Support\Facades\Auth;

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

        // return redirect()->back()->with(['message' => 'Spouse Created Sucessfully']);

        // return redirect()->route('haha', ['cesno' => $cesno]);

        return redirect()->back()->with('message', 'Successfuly Saved');

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

    public function destroySpouse($ctrlno){
        
        $spouse = SpouseRecords::find($ctrlno);
        $spouse->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

    public function destroyChildren($ctrlno){
        
        $children = ChildrenRecords::find($ctrlno);
        $children->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function destroyFather($ctrlno){
        
        $father = Father::find($ctrlno);
        $father->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function destroyMother($ctrlno){
        
        $mother = Mother::find($ctrlno);
        $mother->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

}
