<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TrainingProviderManagerController extends Controller
{
    public function index($cesno)
    {
        $trainingProvider = CompetencyTrainingProvider::all();
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.table', compact('cesno', 'trainingProvider'));
    }

    public function create($cesno)
    {
        $profileLibTblCities = ProfileLibCities::all();
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.form', compact('cesno', 'profileLibTblCities'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'provider' => ['required', 'unique:training_tblProvider,provider'],
            'house_building' => ['required'],
            'st_road' => ['required'],
            'brgy_vill' => ['nullable'],
            'city_code' => ['required'],
            'contact_no' => ['required'],
            'email' => ['required'],
            'contact_person' => ['required'],
        
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;
        $userFullName = $userLastName. ' ' .$userFirstName. ' '.$userMiddleName. ' '.$userNameExtension;

        $trainingProvider = new CompetencyTrainingProvider([

            'provider' => $request->provider,
            'house_bldg' => $request->house_building,
            'st_road' => $request->st_road,
            'brgy_vill' => $request->brgy_vill,
            'city_code' => $request->city_code,
            'contactno' => $request->contact_no,
            'emailadd' => $request->email,
            'contactperson' => $request->contact_person,
            'encoder' => $userFullName,

        ]);

        $cityCode =  $request->city_code;

        $trainingProviderCitiesCode = ProfileLibCities::find($cityCode);

        if(!$trainingProviderCitiesCode){
            return redirect()->back()->with('error', 'Cant Save, Something Went Wrong');
        }else{
            $trainingProviderCitiesCode->competencyTrainingProviderManager()->save($trainingProvider);
        }
        
        return to_route('training-provider-manager.index', ['cesno'=>$cesno])->with('message', 'Training Provider Manager Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $profileLibTblCities = ProfileLibCities::all();
        $trainingProvider = CompetencyTrainingProvider::find($ctrlno);

        if(!$trainingProvider){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.edit', compact('cesno', 'profileLibTblCities', 'trainingProvider'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'provider' => ['required',Rule::unique('training_tblProvider')->ignore($ctrlno, 'providerID')],
            'house_building' => ['required'],
            'st_road' => ['required'],
            'brgy_vill' => ['nullable'],
            'city_code' => ['required'],
            'contact_no' => ['required'],
            'email' => ['required'],
            'contact_person' => ['required'],
        
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;
        $userFullName = $userLastName. ' ' .$userFirstName. ' '.$userMiddleName. ' '.$userNameExtension;

        $trainingProviderManager = CompetencyTrainingProvider::find($ctrlno);
        $trainingProviderManager->provider = $request->provider;
        $trainingProviderManager->house_bldg = $request->house_building;
        $trainingProviderManager->st_road = $request->st_road;
        $trainingProviderManager->brgy_vill = $request->brgy_vill;
        $trainingProviderManager->city_code = $request->city_code;
        $trainingProviderManager->contactno = $request->contact_no;
        $trainingProviderManager->emailadd = $request->email;
        $trainingProviderManager->contactperson = $request->contact_person;
        $trainingProviderManager->updated_by = $userFullName;
        $trainingProviderManager->save();

        return to_route('training-provider-manager.index', ['cesno'=>$cesno])->with('info', 'Training Provider Manager Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingProviderManager = CompetencyTrainingProvider::find($ctrlno);
        $trainingProviderManager->delete();

        return redirect()->back()->with('info', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        $trainingProviderTrashRecord = CompetencyTrainingProvider::onlyTrashed()->get();

        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.trashbin', compact('cesno', 'trainingProviderTrashRecord'));
    }

    public function restore($ctrlno)
    {
        $trainingProviderTrashRecord = CompetencyTrainingProvider::onlyTrashed()->find($ctrlno);
        $trainingProviderTrashRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $trainingProviderTrashRecord = CompetencyTrainingProvider::onlyTrashed()->find($ctrlno);
        $trainingProviderTrashRecord->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');
    }
}
