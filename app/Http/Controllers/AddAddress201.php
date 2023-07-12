<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAddress201Req;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddAddress201 extends Controller
{
    
    public function addAddressPermanent(AddAddress201Req $request, $cesno){

        $type = "Permanent";
        $encoder = "Encoder";

        $existingAddress = ProfileAddress::where('personal_data_cesno', $cesno)
            ->where('type', $type)
            ->first();

        if ($existingAddress) {

            $existingAddress->type = $type;
            $existingAddress->region = $request->regionsSelectPermanent;
            $existingAddress->city_or_municipality = $request->citySelectPermanent;
            $existingAddress->brgy = $request->brgySelectPermanent;
            // $existingAddress->zip_code = $request->zip_code;
            $existingAddress->street_lot_bldg_floor = $request->street_lot_bldg_floor;
            $existingAddress->encoder = $encoder;
            $existingAddress->save();

            return back()->with('message-address-changed','Address changed!');
        }

        $profileAddress = new ProfileAddress([

            'type' => $type,
            'region' => $request->regionsSelectPermanent,
            'city_or_municipality' => $request->citySelectPermanent,
            'brgy' => $request->brgySelectPermanent,
            // 'zip_code' => $request->zip_code,
            'street_lot_bldg_floor' => $request->street_lot_bldg_floor,
            'encoder' => $encoder,
            // 'last_updated_by' => $request->employer_bussiness_telephone,
            
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
