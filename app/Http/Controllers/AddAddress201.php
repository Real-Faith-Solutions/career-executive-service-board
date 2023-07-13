<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAddress201Req;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AddAddress201 extends Controller
{
    
    public function addAddressPermanent(AddAddress201Req $request, $cesno){

        $type = "Permanent";
        $encoder = "Encoder";

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

            return back()->with('message-address-changed','Address changed!');
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

        return back()->with('message-address-added','New address added!');

    }

    public function addAddressMailing(AddAddress201Req $request){

        return back()->with('message','New profile added!');

    }

    public function addAddressTemporary(AddAddress201Req $request){

        return back()->with('message','New profile added!');

    }

}
