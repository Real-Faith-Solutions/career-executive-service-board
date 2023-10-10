<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAddress201Req;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    //
    public function show($cesno){

        $addressProfile = ProfileAddress::where('personal_data_cesno', $cesno)->get();

        if ($addressProfile->isEmpty()) {
            // The $addressProfile variable is empty (no data found).
            // You may want to handle this case accordingly.
        } else {
            $addressProfilePermanent = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Permanent')->first();
            $addressProfileMailing = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Mailing')->first();
            $addressProfileTemp = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Temporary')->first();

            return view('admin.201_profiling.view_profile.partials.address.table', 
            compact('addressProfile', 'addressProfilePermanent', 'addressProfileMailing', 'addressProfileTemp', 'cesno'));
        }

        
        
    }

    public function addAddressPermanent(AddAddress201Req $request, $cesno){

        $type = "Permanent";

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $response = Http::get("https://psgc.gitlab.io/api/regions/".$request->regionsSelectPermanent);
        $region_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/".$request->citySelectPermanent);
        $city_or_municipality_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/barangays/".$request->brgySelectPermanent);
        $brgy_name = $response->json('name');

        $existingAddress = ProfileAddress::where('personal_data_cesno', $cesno)
            ->where('type', $type)
            ->first();

        if ($existingAddress) {

            $existingAddress->type = $type;
            $existingAddress->region_code = $request->regionsSelectPermanent;
            $existingAddress->region_name = $region_name;
            $existingAddress->city_or_municipality_code = $request->citySelectPermanent;
            $existingAddress->city_or_municipality_name = $city_or_municipality_name;
            $existingAddress->brgy_code = $request->brgySelectPermanent;
            $existingAddress->brgy_name = $brgy_name;
            $existingAddress->zip_code = $request->zip_code;
            $existingAddress->street_lot_bldg_floor = $request->street_lot_bldg_floor;
            $existingAddress->encoder = $encoder;
            $existingAddress->save();

            return back()->with('info','Permanent Address Changed!');
        }

        $profileAddress = new ProfileAddress([

            'type' => $type,
            'region_code' => $request->regionsSelectPermanent,
            'region_name' => $region_name,
            'city_or_municipality_code' => $request->citySelectPermanent,
            'city_or_municipality_name' => $city_or_municipality_name,
            'brgy_code' => $request->brgySelectPermanent,
            'brgy_name' => $brgy_name,
            'zip_code' => $request->zip_code,
            'street_lot_bldg_floor' => $request->street_lot_bldg_floor,
            'encoder' => $encoder,
            
        ]);

        $profileAddressId = PersonalData::find($cesno);

        $profileAddressId->profileAddress()->save($profileAddress);

        return back()->with('message','Permanent Address Added!');

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

    public function addAddressTemporary(AddAddress201Req $request, $cesno){

        $type = "Temporary";
       
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $response = Http::get("https://psgc.gitlab.io/api/regions/".$request->regionsSelectTemporary);
        $region_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/".$request->citySelectTemporary);
        $city_or_municipality_name = $response->json('name');

        $response = Http::get("https://psgc.gitlab.io/api/barangays/".$request->brgySelectTemporary);
        $brgy_name = $response->json('name');

        $existingAddress = ProfileAddress::where('personal_data_cesno', $cesno)
            ->where('type', $type)
            ->first();

        if ($existingAddress) {

            $existingAddress->type = $type;
            $existingAddress->region_code = $request->regionsSelectTemporary;
            $existingAddress->region_name = $region_name;
            $existingAddress->city_or_municipality_code = $request->citySelectTemporary;
            $existingAddress->city_or_municipality_name = $city_or_municipality_name;
            $existingAddress->brgy_code = $request->brgySelectTemporary;
            $existingAddress->brgy_name = $brgy_name;
            $existingAddress->zip_code = $request->zip_code_Temp;
            $existingAddress->street_lot_bldg_floor = $request->street_lot_bldg_floor_Temp;
            $existingAddress->encoder = $encoder;
            $existingAddress->save();

            return back()->with('info','Temporary Address Changed!');
        }

        $profileAddress = new ProfileAddress([

            'type' => $type,
            'region_code' => $request->regionsSelectTemporary,
            'region_name' => $region_name,
            'city_or_municipality_code' => $request->citySelectTemporary,
            'city_or_municipality_name' => $city_or_municipality_name,
            'brgy_code' => $request->brgySelectTemporary,
            'brgy_name' => $brgy_name,
            'zip_code' => $request->zip_code_Temp,
            'street_lot_bldg_floor' => $request->street_lot_bldg_floor_Temp,
            'encoder' => $encoder,
            
        ]);

        $profileAddressId = PersonalData::find($cesno);

        $profileAddressId->profileAddress()->save($profileAddress);

        return back()->with('message','Temporary Address Added!');

    }

    public function destroy($ctrlno){

        $address = ProfileAddress::find($ctrlno);
        $address->delete();

        return redirect()->back()->with('message', 'Address Deleted Sucessfully');

    }

}
