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
    public function index()
    {
        $trainingProvider = CompetencyTrainingProvider::all();
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.table', compact('trainingProvider'));
    }

    public function create()
    {
        $profileLibTblCities = ProfileLibCities::all();
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.form', compact('profileLibTblCities'));
    }

    public function store(Request $request)
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingProvider = new CompetencyTrainingProvider([

            'provider' => $request->provider,
            'house_bldg' => $request->house_building,
            'st_road' => $request->st_road,
            'brgy_vill' => $request->brgy_vill,
            'city_code' => $request->city_code,
            'contactno' => $request->contact_no,
            'emailadd' => $request->email,
            'contactperson' => $request->contact_person,
            'encoder' => $encoder,

        ]);

        $cityCode =  $request->city_code;

        $trainingProviderCitiesCode = ProfileLibCities::find($cityCode);

        if(!$trainingProviderCitiesCode){
            return redirect()->back()->with('error', 'Cant Save, Something Went Wrong');
        }else{
            $trainingProviderCitiesCode->competencyTrainingProviderManager()->save($trainingProvider);
        }
        
        return to_route('training-provider-manager.index')->with('message', 'Training Provider Manager Successfuly Saved');
    }

    public function edit($ctrlno)
    {
        $profileLibTblCities = ProfileLibCities::all();
        $trainingProvider = CompetencyTrainingProvider::find($ctrlno);

        if(!$trainingProvider){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.edit', compact('profileLibTblCities', 'trainingProvider'));
    }

    public function update(Request $request, $ctrlno)
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingProviderManager = CompetencyTrainingProvider::find($ctrlno);
        $trainingProviderManager->provider = $request->provider;
        $trainingProviderManager->house_bldg = $request->house_building;
        $trainingProviderManager->st_road = $request->st_road;
        $trainingProviderManager->brgy_vill = $request->brgy_vill;
        $trainingProviderManager->city_code = $request->city_code;
        $trainingProviderManager->contactno = $request->contact_no;
        $trainingProviderManager->emailadd = $request->email;
        $trainingProviderManager->contactperson = $request->contact_person;
        $trainingProviderManager->updated_by = $encoder;
        $trainingProviderManager->save();

        return to_route('training-provider-manager.index')->with('info', 'Training Provider Manager Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingProviderManager = CompetencyTrainingProvider::find($ctrlno);
        $trainingProviderManager->delete();

        return redirect()->back()->with('info', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $trainingProviderTrashRecord = CompetencyTrainingProvider::onlyTrashed()->get();

        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.trashbin', compact('trainingProviderTrashRecord'));
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
