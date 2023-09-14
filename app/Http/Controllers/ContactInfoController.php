<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactInfoController extends Controller
{
    // Competency Profile Contact Information
    public function index($cesno)
    {
        $contacts = Contacts::where('personal_data_cesno', $cesno)->first();
        $email = PersonalData::where('cesno', $cesno)->pluck('email')->first();
        $addressProfileMailing = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Mailing')->first();
        return view('admin.competency.partials.personal_information.contact_information', ['contacts'=>$contacts, 'email' =>$email, 'cesno'=>$cesno, 'addressProfileMailing'=>$addressProfileMailing]);
    }

    // 201 Profile Contact Information  
    public function show($cesno)
    {
        $contacts = Contacts::where('personal_data_cesno', $cesno)->first();
        $email = PersonalData::where('cesno', $cesno)->pluck('email')->first();
        return view('admin.201_profiling.view_profile.partials.contact_information.table', ['contacts'=>$contacts, 'email' =>$email, 'cesno'=>$cesno]);
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([
            'official_email' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:100'],
            'official_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'official_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'personal_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'personal_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'office_telephone_number' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        // Find the associated PersonalData record
        $personalData = PersonalData::findOrFail($cesno);

        // Update or create the associated Contact record
        $contacts = $personalData->contacts()->Create(
            [
                'official_email' => $request->input('official_email'),
                'official_mobile_number1' => $request->input('official_mobile_number1'),
                'official_mobile_number2' => $request->input('official_mobile_number2'),
                'personal_mobile_number1' => $request->input('personal_mobile_number1'),
                'personal_mobile_number2' => $request->input('personal_mobile_number2'),
                'office_telephone_number' => $request->input('office_telephone_number'),
                'encoder' => $encoder,
            ]
        );

        return redirect()->back()->with('message', 'Successfully Saved');
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([
            'official_email' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:100'],
            'official_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'official_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'personal_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'personal_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'office_telephone_number' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $contact = Contacts::find($ctrlno);
        $contact->official_email = $request->official_email;
        $contact->official_mobile_number1 = $request->official_mobile_number1;
        $contact->official_mobile_number2 = $request->official_mobile_number2;
        $contact->personal_mobile_number1 = $request->personal_mobile_number1;
        $contact->personal_mobile_number2 = $request->personal_mobile_number2;
        $contact->office_telephone_number = $request->office_telephone_number;
        $contact->encoder = $encoder;
        $contact->save();

        return redirect()->back()->with('message', 'Updated Successfuly');
    }
}
