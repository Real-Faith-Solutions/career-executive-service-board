<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'official_email' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:9', 'max:100'],
            'official_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'official_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'personal_mobile_number1' => ['required', Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'min:10', 'max:20'],
            'personal_mobile_number2' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
            'office_telephone_number' => [Rule::unique('profile_tblContact')->ignore($cesno, 'personal_data_cesno'), 'max:20'],
        ]);
  
        // Retrieve encoder information
        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;
  
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
                'encoder' => $userLastName . ' ' . $userFirstName . ' ' . $userMiddleName . ' ' . $userNameExtension,
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
  
        // Retrieve encoder information
        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;
  
        $contact = Contacts::find($ctrlno);
        $contact->official_email = $request->official_email;
        $contact->official_mobile_number1 = $request->official_mobile_number1;
        $contact->official_mobile_number2 = $request->official_mobile_number2;
        $contact->personal_mobile_number1 = $request->personal_mobile_number1;
        $contact->personal_mobile_number2 = $request->personal_mobile_number2;
        $contact->office_telephone_number = $request->office_telephone_number;
        $contact->encoder = $userLastName . ' ' . $userFirstName . ' ' . $userMiddleName . ' ' . $userNameExtension;
        $contact->save();
  
        return redirect()->back()->with('message', 'Updated Successfuly');
  
    }

    public function updateEmail(Request $request, $cesno)
    {
        $request->validate([
            'email' => ['required', Rule::unique('profile_tblMain')->ignore($cesno, 'cesno'), 'min:9', 'max:100'],
        ]);
  
        // update email in personal data
        $email = PersonalData ::find($cesno);
        $email->email = $request->email;

        if(!$email){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }else{
            $email->save();
        }

        // user email
        $contactEmail = $request->email;

        // update email in contacts
        $contact = Contacts::find($cesno);
        $contact->official_email = $contactEmail;
        $contact->save();
  
        return redirect()->back()->with('message', 'Email Updated Successfuly');
    }
}
