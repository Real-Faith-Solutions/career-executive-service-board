<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentAgencyController extends Controller
{

    public function addPlantillaTblDeptAgency(Request $request) {

        PlantillaTblDeptAgency::create([
            'deptid' => $request->deptid,
            'title' => $request->title,
            'acronym' => $request->acronym,
            'agency_deptid' => $request->agency_deptid,
            'mother_deptid' => $request->mother_deptid,
            'sectorid' => $request->sectorid,
            'website' => $request->website,
            'lastsubmit_dt' => $request->lastsubmit_dt,
            'submitted_by' => $request->submitted_by,
            'remarks' => $request->remarks,
            'encdate' => $request->encdate,
            'lastupd_dt' => $request->lastupd_dt,
            'encoder' => $request->encoder,
        ]);   
    }

    public function getPlantillaTblDeptAgency(Request $request){
        $PlantillaTblDeptAgency = PlantillaTblDeptAgency::all();

        return $PlantillaTblDeptAgency;
    }
}
