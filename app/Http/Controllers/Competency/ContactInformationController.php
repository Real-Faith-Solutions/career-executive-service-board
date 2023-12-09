<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAddress201Req;
use App\Models\Contacts;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ContactInformationController extends Controller
{
    // email
    public function updateOrCreate($cesno)
    {
        $contacts = Contacts::where('personal_data_cesno', $cesno)->first();
        $email = PersonalData::where('cesno', $cesno)->pluck('emailadd')->first();
        $personalData = PersonalData::find($cesno);
        
        $addressProfileMailing = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Mailing')->first();

        return view('admin.competency.partials.personal_information.contact_information', [
            'contacts'=>$contacts, 
            'email' =>$email, 
            'cesno'=>$cesno, 
            'addressProfileMailing'=>$addressProfileMailing,
            'personalData' => $personalData
        ]);
    }
  
    // store contact information
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
  
    // update contact information
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

    // update email in profile table main and contact
    public function updateEmail(Request $request, $cesno)
    {
        // $request->validate([
        //     'email' => ['required', Rule::unique('profile_tblMain')->ignore($cesno, 'cesno'), 'min:9', 'max:100'],
        // ]);
  
        // update email in profile_tblMain
        $email = PersonalData ::find($cesno);
        $email->email = $request->email;
        $email->save();

        // update email in profile table contacts
        Contacts::where('personal_data_cesno', $cesno)->update(['official_email' => $request->email]);

        return redirect()->back()->with('info', 'Email Updated Successfuly');
    }
    
    public function addAddressMailing(AddAddress201Req $request, $cesno){

        $type = "Mailing";

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $response = Http::get("https://psgc.gitlab.io/api/regions/".$request->regionsSelectMailing);
        $region_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/".$request->citySelectMailing);
        $city_or_municipality_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/barangays/".$request->brgySelectMailing);
        $brgy_name = $response->json('name');

        $existingAddress = ProfileAddress::where('personal_data_cesno', $cesno)
            ->where('type', $type)
            ->first();

        if ($existingAddress) {

            $existingAddress->type = $type;
            $existingAddress->region_code = $request->regionsSelectMailing;
            $existingAddress->region_name = $region_name;
            $existingAddress->city_or_municipality_code = $request->citySelectMailing;
            $existingAddress->city_or_municipality_name = $city_or_municipality_name;
            $existingAddress->brgy_code = $request->brgySelectMailing;
            $existingAddress->brgy_name = $brgy_name;
            $existingAddress->zip_code = $request->zip_code_Mailing;
            $existingAddress->street_lot_bldg_floor = $request->street_lot_bldg_floor_Mailing;
            $existingAddress->encoder = $encoder;
            $existingAddress->save();

            return back()->with('info','Mailing Address Changed!');
        }

        $profileAddress = new ProfileAddress([

            'type' => $type,
            'region_code' => $request->regionsSelectMailing,
            'region_name' => $region_name,
            'city_or_municipality_code' => $request->citySelectMailing,
            'city_or_municipality_name' => $city_or_municipality_name,
            'brgy_code' => $request->brgySelectMailing,
            'brgy_name' => $brgy_name,
            'zip_code' => $request->zip_code_Mailing,
            'street_lot_bldg_floor' => $request->street_lot_bldg_floor_Mailing,
            'encoder' => $encoder,
            
        ]);

        $profileAddressId = PersonalData::find($cesno);

        $profileAddressId->profileAddress()->save($profileAddress);

        return back()->with('message','Mailing Address Added!');

    }
}
