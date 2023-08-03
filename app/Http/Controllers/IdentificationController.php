<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IdentificationController extends Controller
{

    public function show($cesno){

        $identification = Identification::where('personal_data_cesno', $cesno)->first();

        return view('admin.201_profiling.view_profile.partials.identification.table', 
        ['identification'=>$identification, 'cesno'=>$cesno]);
        
    }

    public function store(Request $request, $cesno){

        $request->validate([

            'gsis' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'pagibig' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'philhealth' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'sss_no' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'tin' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
        
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $personalData = PersonalData::findOrFail($cesno);

        // Update or create the associated Identification record
        $identification = $personalData->identifications()->Create(
            [
                'gsis' => $request->input('gsis'),
                'pagibig' => $request->input('pagibig'),
                'philhealth' => $request->input('philhealth'),
                'sss_no' => $request->input('sss_no'),
                'tin' => $request->input('tin'),
                'encoder' => $userLastName . ' ' . $userFirstName . ' ' . $userMiddleName . ' ' . $userNameExtension,
            ]
        );

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $identification = Identification::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.identification.edit', ['identification'=>$identification]) ;

    }

    public function update(Request $request, $ctrlno, $cesno){

        $request->validate([

            'gsis' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'pagibig' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'philhealth' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'sss_no' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'tin' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
        
        ]);

        // Retrieve encoder information
        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $identification = Identification::find($ctrlno);
        $identification->gsis = $request->gsis;
        $identification->pagibig = $request->pagibig;
        $identification->philhealth = $request->philhealth;
        $identification->sss_no = $request->sss_no;
        $identification->tin = $request->tin;
        $identification->encoder = $userLastName . ' ' . $userFirstName . ' ' . $userMiddleName . ' ' . $userNameExtension;
        $identification->save();
 
         return back()->with('message', 'Updated Sucessfully');
        
    }

    public function destroyIdentification($ctrlno){
        
        $spouse = Identification::find($ctrlno);
        $spouse->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
