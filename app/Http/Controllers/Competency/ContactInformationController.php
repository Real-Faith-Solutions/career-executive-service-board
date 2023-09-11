<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ContactInformationController extends Controller
{
    public function updateOrCreate($cesno)
    {
        $contacts = Contacts::where('personal_data_cesno', $cesno)->first();
        $email = PersonalData::where('cesno', $cesno)->pluck('email')->first();

        return view('admin.competency.partials.personal_information.contact_information', ['contacts'=>$contacts, 'email' =>$email, 'cesno'=>$cesno]);
    }
  
    public function store(Request $request, $cesno)
    {
        $request->validate([
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
        $contact->official_mobile_number1 = $request->official_mobile_number1;
        $contact->official_mobile_number2 = $request->official_mobile_number2;
        $contact->personal_mobile_number1 = $request->personal_mobile_number1;
        $contact->personal_mobile_number2 = $request->personal_mobile_number2;
        $contact->office_telephone_number = $request->office_telephone_number;
        $contact->encoder = $encoder;
        $contact->save();
  
        return redirect()->back()->with('info', 'Updated Successfuly');
  
    }

    public function updateEmail(Request $request, $cesno)
    {
        $request->validate([
            'email' => ['required', Rule::unique('profile_tblMain')->ignore($cesno, 'cesno'), 'min:9', 'max:100'],
        ]);
  
        // update email in personal data
        $email = PersonalData ::find($cesno);
        $email->email = $request->email;
        $email->save();

        // update email in contacts
        Contacts::where('personal_data_cesno', $cesno)->update(['official_email' => $request->email]);

        return redirect()->back()->with('info', 'Email Updated Successfuly');
    }
}
