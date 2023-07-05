<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddProfile201 extends Controller
{
    //
    public function store(AddProfile201Req $request)
    {
        $indigenous = $request->member_of_indigenous_group;

        $pwd = $request->person_with_disability;

        if($request->member_of_indigenous_group == "Others"){
            $indigenous = $request->moig_others;
        }

        if($request->person_with_disability == "Yes"){
            $pwd = $request->dependent_pwd_input;
        }

        $newProfile = PersonalData::create([
            
            'status' => $request->status,
            'title' => $request->title,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'name_extension' => $request->name_extension,
            'middlename' => $request->middlename,
            'mi' => $request->mi,
            'nickname' => $request->nickname,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'gender_by_choice' => $request->gender_by_choice,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'member_of_indigenous_group' => $indigenous,
            'single_parent' => $request->single_parent,
            'citizenship' => $request->citizenship,
            'dual_citizenship' => $request->dual_citizenship,
            'person_with_disability' => $pwd,
            'gsis' => $request->gsis,
            'pagibig' => $request->pagibig,
            'philhealth' => $request->philhealth,
            'sss_no' => $request->sss_no,
            'tin' => $request->tin,

        ]);

        if (DB::table('personal_data')->count() === 0) {
            $cesNumber = 0;
        } else {
            $cesNumber = PersonalData::latest()->first()->cesno;
        }

        return view('admin.201_profiling.create_profile.form', ['cesNumber' => ++$cesNumber]);

    }

}
