<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\IndigenousGroup;
use App\Models\PWD;
use App\Models\GenderByChoice;
use App\Models\GenderByBirth;
use App\Models\NameExtension;
use App\Models\CivilStatus;
use App\Models\Title;
use App\Models\RecordStatus;
use App\Models\Religion;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{

    public function addProfile()
    {
        if (DB::table('profile_tblMain')->count() === 0) {
            $cesNumber = 0;
        } else {
            $cesNumber = PersonalData::latest()->first()->cesno;
        }

        $countries = Country::all();
        $indigenousGroups = IndigenousGroup::all();
        $pwds = PWD::all();
        $genderByChoices = GenderByChoice::all();
        $genderByBirths = GenderByBirth::all();
        $nameExtensions = NameExtension::all();
        $civilStatus = CivilStatus::all();
        $title = Title::all();
        $recordStatus = RecordStatus::all();
        $religion = Religion::all();

        return view('admin.201_profiling.create_profile.form',[
            'cesNumber' => ++$cesNumber,
            'countries' => $countries,
            'indigenousGroups' => $indigenousGroups,
            'pwds' => $pwds,
            'genderByChoices' => $genderByChoices,
            'genderByBirths' => $genderByBirths,
            'nameExtensions' => $nameExtensions,
            'civilStatus' => $civilStatus,
            'title' => $title,
            'recordStatus' => $recordStatus,
            'religion' => $religion,

        ]);
    }

    public function editProfile($cesno)
    {
        if (DB::table('profile_tblMain')->count() === 0) {
            $cesNumber = 0;
        } else {
            $cesNumber = PersonalData::latest()->first()->cesno;
        }

        $mainProfile = PersonalData::find($cesno);
        $countries = Country::all();
        $indigenousGroups = IndigenousGroup::all();
        $pwds = PWD::all();
        $genderByChoices = GenderByChoice::all();
        $genderByBirths = GenderByBirth::all();
        $nameExtensions = NameExtension::all();
        $civilStatus = CivilStatus::all();
        $title = Title::all();
        $recordStatus = RecordStatus::all();
        $religion = Religion::all();

        return view('admin.201_profiling.view_profile.partials.personal_data.edit',[
            'cesNumber' => $cesno,
            'mainProfile' => $mainProfile,
            'countries' => $countries,
            'indigenousGroups' => $indigenousGroups,
            'pwds' => $pwds,
            'genderByChoices' => $genderByChoices,
            'genderByBirths' => $genderByBirths,
            'nameExtensions' => $nameExtensions,
            'civilStatus' => $civilStatus,
            'title' => $title,
            'recordStatus' => $recordStatus,
            'religion' => $religion,

        ]);
    }

    public function update(AddProfile201Req $request, $cesno)
    {

        $encoder = View::shared('userName');

        $newProfile = PersonalData::create([
            
            'status' => $request->status,
            'title' => $request->title,
            'email' => $request->email,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'name_extension' => $request->name_extension,
            'middlename' => $request->middlename,
            'middleinitial' => $request->mi,
            'nickname' => $request->nickname,
            'birth_date' => $request->birthdate,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'gender_by_choice' => $request->gender_by_choice,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'member_of_indigenous_group' => $request->member_of_indigenous_group,
            'single_parent' => $request->single_parent,
            'citizenship' => $request->citizenship,
            'dual_citizenship' => $request->dual_citizenship,
            'person_with_disability' => $request->person_with_disability,
            'encoder' => $encoder,

        ]);

        return back()->with('message','New profile added!'.$encoder);

    }

}