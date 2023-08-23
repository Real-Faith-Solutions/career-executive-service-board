<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildrenStoreRequest;
use App\Http\Requests\FatherStoreRequest;
use App\Http\Requests\MotherStoreRequest;
use App\Http\Requests\SpouseStoreRequest;
use App\Models\ChildrenRecords;
use App\Models\Father;
use App\Models\GenderByBirth;
use App\Models\Mother;
use App\Models\NameExtension;
use App\Models\PersonalData;
use App\Models\SpouseRecords;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
// display record for spouse, children, father, mother
    public function show($cesno)
    {
        $father = Father::where('personal_data_cesno', $cesno)->get();
        $mother = Mother::where('personal_data_cesno', $cesno)->get();
        $childrenRecords = ChildrenRecords::where('personal_data_cesno', $cesno)->get();
        $SpouseRecords = SpouseRecords::where('personal_data_cesno', $cesno)->get();
        $nameExtensions = NameExtension::all();
        $genderLibrary = GenderByBirth::all();

        return view('admin.201_profiling.view_profile.partials.family_profile.table',
        compact('father', 'mother', 'childrenRecords', 'SpouseRecords', 'nameExtensions', 'cesno', 'genderLibrary'));
    }
// end

// display soft delete records of spouse, children
    public function familyProfileRecentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted spouses of the parent model
        $spousesTrashedRecord = $personalData->spouses()->onlyTrashed()->get();

        // Access the soft deleted childrens of the parent model
        $childrensTrashedRecord = $personalData->childrens()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.family_profile.trashbin', compact('spousesTrashedRecord', 'childrensTrashedRecord', 'cesno'));
    }
// end

// SPOUSE METHODS
    // store spouse data
        public function storeSpouse(SpouseStoreRequest $request, $cesno)
        {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName();    

            $personalData = new SpouseRecords([

                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'name_extension' => $request->name_extension,
                'occupation' => $request->occupation,
                'employer_business_name' => $request->employer_bussiness_name,
                'employer_business_address' => $request->employer_bussiness_address,
                'employer_business_telephone' => $request->employer_bussiness_telephone,
                'encoder' => $encoder,
            ]);

            $PersonalDataId = PersonalData::find($cesno);

            $PersonalDataId->spouses()->save($personalData);

            return redirect()->back()->with('message', 'Successfuly Saved');
        }
    // end store spouse data

    // spouse edit form
        public function editSpouse($ctrlno, $cesno)
        {
            $spouseRecord = SpouseRecords::find($ctrlno);
            $nameExtensions = NameExtension::all();

            return view('admin.201_profiling.view_profile.partials.family_profile.edit_spouse', compact('nameExtensions', 'spouseRecord', 'cesno'));
        }
    // end spouse edit form

    // update spouse data
        public function updateSpouseRecord(SpouseStoreRequest $request, $ctrlno)
        {
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
    // end update spouse data

    // soft deleting spouse data
        public function destroySpouse($ctrlno)
        {
            $spouse = SpouseRecords::find($ctrlno);
            $spouse->delete();

            return redirect()->back()->with('message', 'Deleted Sucessfully');
        }
    // end soft deleting spouse data

    // restore soft deleted spouse data 
        public function spouseRestore($ctrlno)
        {
            $spouse = SpouseRecords::withTrashed()->find($ctrlno);
            $spouse->restore();

            return back()->with('message', 'Data Restored Sucessfully');
        }
    // end restore soft deleted spouse data
    
    // permanently delete soft deleted spouse data 
        public function spouseForceDelete($ctrlno)
        {
            $spouse = SpouseRecords::withTrashed()->find($ctrlno);
            $spouse->forceDelete();

            return back()->with('message', 'Data Permanently Deleted');
        }
    // end permanently delete soft deleted spouse data
// END SPOUSE METHODS

// CHILDREN METHODS
    // store children data
        public function storeChildren(ChildrenStoreRequest $request, $cesno)
        {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName(); 

            $childrenRecord = new ChildrenRecords([

                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'name_extension' => $request->name_extension,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'birth_place' => $request->birth_place,
                'encoder' => $encoder,

            ]);

            $ChildrenPersonalDataId = PersonalData::find($cesno);

            $ChildrenPersonalDataId->childrens()->save($childrenRecord);

            return redirect()->back()->with('message', 'Successfuly Saved');
        }
    // end store children data

    // children edit form
        public function editChildren($ctrlno, $cesno)
        {
            $nameExtensions = NameExtension::all();
            $childrenRecords = ChildrenRecords::find($ctrlno);
            $genderLibrary = GenderByBirth::all();

            return view('admin.201_profiling.view_profile.partials.family_profile.edit_children', compact('nameExtensions', 'childrenRecords', 'cesno', 'genderLibrary'));
        }
    // end children edit form

    // update children data
        public function updateChildrenRecord(ChildrenStoreRequest $request, $ctrlno)
        {
            $childrenRecord = ChildrenRecords::find($ctrlno);
            $childrenRecord->last_name = $request->last_name;
            $childrenRecord->first_name = $request->first_name;
            $childrenRecord->middle_name = $request->middle_name;
            $childrenRecord->name_extension = $request->name_extension;
            $childrenRecord->gender = $request->gender;
            $childrenRecord->birthdate = $request->birthdate;
            $childrenRecord->birth_place = $request->birth_place;
            $childrenRecord->save();

            return redirect()->back()->with('message', 'Updated Successfuly');
        }
    // end update children data

    // soft deleting children data
        public function destroyChildren($ctrlno)
        {
            $children = ChildrenRecords::find($ctrlno);
            $children->delete();

            return redirect()->back()->with('message', 'Deleted Sucessfully');
        }
    // end soft deleting children data

    // restore soft deleted children data
        public function childrenRestore($ctrlno)
        {
            $children = ChildrenRecords::withTrashed()->find($ctrlno);
            $children->restore();

            return back()->with('message', 'Data Restored Sucessfully');
        }
    // end restore soft deleted children data

    // permanently delete soft deleted children data
        public function childrenForceDelete($ctrlno)
        {
            $children = ChildrenRecords::withTrashed()->find($ctrlno);
            $children->forceDelete();

            return back()->with('message', 'Data Permanently Deleted');
        }
    // end permanently delete soft deleted children data
// END CHILDREN METHODS

// FATHER METHODS
    // store father data
        public function storeFather(FatherStoreRequest $request, $cesno)
        {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName(); 

            $fatherDetails = new Father([

                'father_last_name' => $request->father_last_name,
                'father_first_name' => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'name_extension' => $request->father_name_extension,
                'encoder' => $encoder,

            ]);

            $fatherPersonalDataId = PersonalData::find($cesno);
    
            if(Father::where('personal_data_cesno', $cesno)->exists()){

                return redirect()->back()->with('error', 'Already Have Details');

            }else{

                $fatherPersonalDataId->father()->save($fatherDetails);

            }

            return redirect()->back()->with('message', 'Successfuly Saved');
        }
    // end store father data

    // father edit form
        public function editFather($ctrlno, $cesno)
        {
            $nameExtensions = NameExtension::all();
            $father = Father::find($ctrlno);

            return view('admin.201_profiling.view_profile.partials.family_profile.edit_father', compact('nameExtensions', 'father', 'cesno'));
        }
    // end father edit form

    // update father data
        public function updateFatherRecord(FatherStoreRequest $request, $ctrlno)
        {
            $father = Father::find($ctrlno);
            $father->father_last_name = $request->father_last_name;
            $father->father_first_name = $request->father_first_name;
            $father->father_middle_name = $request->father_middle_name;
            $father->name_extension = $request->father_name_extension;
            $father->save();

            return redirect()->back()->with('message', 'Updated Successfuly');
        }
    // end update father data

    // soft deleting father data
        public function destroyFather($ctrlno)
        {
            $father = Father::find($ctrlno);
            $father->delete();

            return redirect()->back()->with('message', 'Deleted Sucessfully');
        }
    // end soft deleting father data
// END FATHER METHODS

// MOTHER METHODS
    // store mother data
        public function storeMother(MotherStoreRequest $request, $cesno)
        {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName(); 

            $motherDetails = new Mother([

                'mother_last_name' => $request->mother_last_name,
                'mother_first_name' => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name,
                'encoder' => $encoder,

            ]);

            $motherPersonalDataId = PersonalData::find($cesno);

            if(Mother::where('personal_data_cesno', $cesno)->exists()){

                return redirect()->back()->with('error', 'Already Have Details');

            }else{

                $motherPersonalDataId->mother()->save($motherDetails);

            }

            return redirect()->back()->with('message', 'Successfuly Saved');
        }
    //end store mother data

    // mother edit form
        public function editMother($ctrlno, $cesno)
        {
            $mother = Mother::find($ctrlno);

            return view('admin.201_profiling.view_profile.partials.family_profile.edit_mother', compact('mother', 'cesno'));
        }
    // end mother edit form

    // update mother record
        public function updateMotherRecord(MotherStoreRequest $request, $ctrlno)
        {
            $mother = Mother::find($ctrlno);
            $mother->mother_last_name = $request->mother_last_name;
            $mother->mother_first_name = $request->mother_first_name;
            $mother->mother_middle_name = $request->mother_middle_name;
            $mother->save();

            return redirect()->back()->with('message', 'Updated Successfuly');
        }
    // end update mother record

    // soft deleting mother data
        public function destroyMother($ctrlno)
        {
            $mother = Mother::find($ctrlno);
            $mother->delete();

            return redirect()->back()->with('message', 'Deleted Sucessfully');
        }
    // end soft deleting mother data
//END MOTHER METHODS
}