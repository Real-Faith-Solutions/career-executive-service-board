<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibCities;
use App\Models\ResourceSpeaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ResourceSpeakerController extends Controller
{
    public function index()
    {
        $resourceSpeaker = ResourceSpeaker::paginate(20);

        return view('admin.competency.partials.trainings_sub_module.resource_speaker.table', compact('resourceSpeaker'));
    }

    public function create()
    {
        $profileLibCIties = ProfileLibCities::all();

        return view('admin.competency.partials.trainings_sub_module.resource_speaker.form', compact('profileLibCIties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastName' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'firstName' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'middleName' => ['nullable', 'max:60', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'position' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'department' => ['nullable', 'max:60', 'min:2'],
            'office' => ['required', 'max:60', 'min:2'],
            'bldg' => ['nullable', 'max:60', 'min:2'],
            'street' => ['nullable', 'max:60', 'min:2'],
            'brgy' => ['nullable', 'max:60', 'min:2'],
            'city' => ['required'],
            'contactNo' => ['required', 'max:60', 'min:10', 'unique:training_tblSpeakers,contactno'],
            'emailAdd' => ['required', 'unique:training_tblSpeakers,emailadd'],
            'expertise' => ['nullable', 'max:60', 'min:6', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $cityName = $request->city;
        $zipCode = ProfileLibCities::where('name', $cityName)->value('zipcode');

        ResourceSpeaker::create([
            'lastname' => $request->lastName,
            'firstname' => $request->firstName,  
            'mi' => $request->middleName,  
            'Position' => $request->position,  
            'Department' => $request->department,  
            'Office' => $request->office,  
            'Bldg' => $request->bldg,  
            'Street' => $request->street,  
            'Brgy' => $request->brgy,  
            'City' => $request->city,  
            'zipcode' => $zipCode,  
            'contactno' => $request->contactNo,  
            'emailadd' => $request->emailAdd,  
            'expertise' => $request->expertise,  
            'encoder' => $encoder,  
        ]);

        return to_route('resource-speaker.index')->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno)
    {
        $resourceSpeaker = ResourceSpeaker::find($ctrlno);

        if(!$resourceSpeaker){
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $profileLibCIties = ProfileLibCities::all();

        return view('admin.competency.partials.trainings_sub_module.resource_speaker.edit', compact('resourceSpeaker','profileLibCIties'));
    }

    public function update(Request $request, $ctrlno)
    {
        $request->validate([
            'lastName' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'firstName' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'middleName' => ['nullable', 'max:60', 'min:1', 'regex:/^[a-zA-Z ]*$/'],
            'position' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'department' => ['nullable', 'max:60', 'min:2'],
            'office' => ['required', 'max:60', 'min:2'],
            'bldg' => ['nullable', 'max:60', 'min:2'],
            'street' => ['nullable', 'max:60', 'min:2'],
            'brgy' => ['nullable', 'max:60', 'min:2'],
            'city' => ['required'],
            'contactNo' => ['required', 'max:60', 'min:10', Rule::unique('training_tblSpeakers')->ignore($ctrlno, 'speakerID')],
            'emailAdd' => ['required', Rule::unique('training_tblSpeakers')->ignore($ctrlno, 'speakerID')],
            'expertise' => ['nullable', 'max:60', 'min:6', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $cityName = $request->city;
        $zipCode = ProfileLibCities::where('name', $cityName)->value('zipcode');

        $resourceSpeaker = ResourceSpeaker::find($ctrlno);
        $resourceSpeaker->lastname = $request->lastName;
        $resourceSpeaker->firstname = $request->firstName;
        $resourceSpeaker->mi = $request->middleName;
        $resourceSpeaker->Position = $request->position;
        $resourceSpeaker->Department = $request->department;
        $resourceSpeaker->Office = $request->office;
        $resourceSpeaker->Bldg = $request->bldg;
        $resourceSpeaker->Street = $request->street;
        $resourceSpeaker->Brgy = $request->brgy;
        $resourceSpeaker->City = $request->city;
        $resourceSpeaker->zipcode = $zipCode;
        $resourceSpeaker->contactno = $request->contactNo;
        $resourceSpeaker->emailadd = $request->emailAdd;
        $resourceSpeaker->expertise = $request->expertise;
        $resourceSpeaker->updated_by = $encoder;
        $resourceSpeaker->save();

        return to_route('resource-speaker.index')->with('info', 'Data Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $resourceSpeaker = ResourceSpeaker::find($ctrlno);
        $resourceSpeaker->delete();

        return back()->with('message', 'Deleted Sucessfully');    
    }

    public function recentlyDeleted()
    {
        $resourceSpeakerTrashedRecord = ResourceSpeaker::onlyTrashed()->paginate(5);

        return view('admin.competency.partials.trainings_sub_module.resource_speaker.trashbin', compact('resourceSpeakerTrashedRecord'));
    }

    public function restore($ctrlno)
    {
        $resourceSpeaker = ResourceSpeaker::onlyTrashed()->find($ctrlno);
        $resourceSpeaker->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $resourceSpeaker = ResourceSpeaker::onlyTrashed()->find($ctrlno);
        $resourceSpeaker->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }

    public function trainingEnagagement($ctrlno)
    {
        $resourceSpeaker = ResourceSpeaker::find($ctrlno);

        $trainingEnagagement = $resourceSpeaker->trainingEnagagement()->paginate(25);

        return view('admin.competency.partials.trainings_sub_module.resource_speaker.training_engagement', compact('trainingEnagagement'));
    }
}
