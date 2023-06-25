<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeManagerController extends Controller
{
    public function addPlantillaTblOffice(Request $request) {

        PlantillaTblOffice::create([
            'officeid' => $request->officeid,
            'officelocid' => $request->officelocid,
            'title' => $request->title,
            'acronym' => $request->acronym,
            'website' => $request->website,
            'encdate' => $request->encdate,
            'encoder' => $request->encoder,
            'lastupd_dt' => $request->lastupd_dt,
            'lastupd_enc' => $request->lastupd_enc,
            'is_active' => $request->is_active,
        ]);
    }

    public function getPlantillaTblOffice(Request $request){
        $PlantillaTblOffice = PlantillaTblOffice::all();

        return $PlantillaTblOffice;
    }
    
}
