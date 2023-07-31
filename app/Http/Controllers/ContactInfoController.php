<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactInfoController extends Controller
{
    public function show($cesno){

        $contacts = Contacts::where('personal_data_cesno', $cesno)->first();
        return view('admin.201_profiling.view_profile.partials.contact_information.table', ['contacts'=>$contacts, 'cesno'=>$cesno]);

    }

    public function store(Request $request, $cesno){

        $request->validate([

            // 'type' => ['required', Rule::unique('identifications')->where('personal_data_cesno', $cesno)],
            'gsis' => ['required', 'unique:identifications,gsis', 'min:9', 'max:40'],
            'pagibig' => ['required', 'unique:identifications,pagibig', 'min:9', 'max:40'],
            'philhealth' => ['required', 'unique:identifications,philhealth', 'min:9', 'max:40'],
            'sss_no' => ['required', 'unique:identifications,sss_no', 'min:9', 'max:40'],
            'tin' => ['required', 'unique:identifications,tin', 'min:9', 'max:40'],
        
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $personalData = PersonalData::findOrFail($cesno);

        // Update or create the associated Identification record
        $identification = $personalData->identifications()->updateOrCreate(
            ['personal_data_cesno' => $cesno],
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

}
