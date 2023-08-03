<?php

namespace App\Http\Controllers;

use App\Models\ProfileAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function show($cesno){

        $addressProfile = ProfileAddress::where('personal_data_cesno', $cesno)->get();
        $addressProfilePermanent = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Permanent')->first();
        $addressProfileMailing = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Mailing')->first();
        $addressProfileTemp = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Temporary')->first();

        return view('admin.201_profiling.view_profile.partials.address.table', 
        compact('addressProfile', 'addressProfilePermanent', 'addressProfileMailing', 'addressProfileTemp', 'cesno'));
        
    }

}
