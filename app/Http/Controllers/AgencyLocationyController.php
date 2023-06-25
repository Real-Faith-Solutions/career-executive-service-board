<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgencyLocationyController extends Controller
{
    public function addPlantillaTblAgencyLocation(Request $request) {

        PlantillaTblAgencyLocation::create([
            'officelocid' => $request->officelocid,
            'deptid' => $request->deptid,
            'title' => $request->title,
            'acronym' => $request->acronym,
            'loctype_id' => $request->loctype_id,
            'telno' => $request->telno,
            'emailaddr' => $request->emailaddr,
            'region' => $request->region,
            'encdate' => $request->encdate,
            'lastupd_dt' => $request->lastupd_dt,
            'encoder' => $request->encoder,
            'lastupd_enc' => $request->lastupd_enc,
        ]);   
    }

    public function getPlantillaTblAgencyLocation(Request $request){
        $PlantillaTblAgencyLocation = PlantillaTblAgencyLocation::all();

        return $PlantillaTblAgencyLocation;
    }
}
