<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IdentificationController extends Controller
{
    public function show($cesno)
    {
        $identification = Identification::where('personal_data_cesno', $cesno)->first();

        return view('admin.201_profiling.view_profile.partials.identification.form', 
        ['identification'=>$identification, 'cesno'=>$cesno]);
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'gsis' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'pagibig' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'philhealth' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'sss_no' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'tin' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
        
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $personalData = PersonalData::findOrFail($cesno);

        // Update or create the associated Identification record
        $identification = $personalData->identifications()->Create(
            [
                'gsis' => $request->input('gsis'),
                'pagibig' => $request->input('pagibig'),
                'philhealth' => $request->input('philhealth'),
                'sss_no' => $request->input('sss_no'),
                'tin' => $request->input('tin'),
                'encoder' => $encoder,
            ]
        );

        return redirect()->back()->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno)
    {
        $identification = Identification::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.identification.edit', ['identification'=>$identification]) ;
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'gsis' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'pagibig' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'philhealth' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'sss_no' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
            'tin' => ['required', Rule::unique('identifications')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:40'],
        
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $identification = Identification::find($ctrlno);
        $identification->gsis = $request->gsis;
        $identification->pagibig = $request->pagibig;
        $identification->philhealth = $request->philhealth;
        $identification->sss_no = $request->sss_no;
        $identification->tin = $request->tin;
        $identification->encoder =  $encoder;
        $identification->save();
 
         return back()->with('message', 'Updated Sucessfully');
    }

    public function destroyIdentification($ctrlno)
    {
        $identification = Identification::find($ctrlno);
        $identification->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }
}
