<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileLibTblAreaCode;
use App\Models\ProfileLibTblEducDegree;
use App\Models\ProfileLibTblEducMajor;
use App\Models\ProfileLibTblEducSchool;
use App\Models\ProfileLibTblExamRef;
use App\Models\ProfileLibTblLanguageRef;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileLibTblCesStatusType;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileLibTblCaseNature;
use App\Models\ProfileLibTblCaseStatus;
use App\Models\ProfileLibTblCities;
use App\Models\ProfileLibTblProvince;
use App\Models\ProfileLibTblRegion;


class LibraryController extends Controller
{
    public function index(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('System Utility') == 'true'){

            $CityMunicipality = ProfileLibTblAreaCode::orderBy('created_at', 'desc')->get();
            $Degree = ProfileLibTblEducDegree::orderBy('created_at', 'desc')->get();
            $CourseMajor = ProfileLibTblEducMajor::orderBy('created_at', 'desc')->get();
            $School = ProfileLibTblEducSchool::orderBy('created_at', 'desc')->get();
            $ExaminationReference = ProfileLibTblExamRef::orderBy('created_at', 'desc')->get();
            $LanguageDialects = ProfileLibTblLanguageRef::orderBy('created_at', 'desc')->get();
            $CesStatusReference = ProfileLibTblCesStatus::orderBy('created_at', 'desc')->get();
            $AcquiredThru = ProfileLibTblCesStatusAcc::orderBy('created_at', 'desc')->get();
            $StatusType = ProfileLibTblCesStatusType::orderBy('created_at', 'desc')->get();
            $AppointingAuthority = ProfileLibTblAppAuthority::orderBy('created_at', 'desc')->get();
            $ExpertiseCategory = ProfileLibTblExpertiseGen::orderBy('created_at', 'desc')->get();
            $SpecialSkill = ProfileLibTblExpertiseSpec::orderBy('created_at', 'desc')->get();
            $CaseNature = ProfileLibTblCaseNature::orderBy('created_at', 'desc')->get();
            $CaseStatus = ProfileLibTblCaseStatus::orderBy('created_at', 'desc')->get();
            $LocationCity = ProfileLibTblCities::orderBy('created_at', 'desc')->get();
            $LocationProvince = ProfileLibTblProvince::orderBy('created_at', 'desc')->get();
            $LocationRegion = ProfileLibTblRegion::orderBy('created_at', 'desc')->get();
            // dd($CityMunicipality);
            return view('admin.201_library.index', compact('CityMunicipality','Degree','CourseMajor','School','ExaminationReference','LanguageDialects','CesStatusReference',
            'AcquiredThru','StatusType','AppointingAuthority','ExpertiseCategory','SpecialSkill','CaseNature','CaseStatus','LocationCity','LocationProvince','LocationRegion'))->render();

        }
        else{

            return view('restricted');
        }
        
    }

    public function addCityMunicipality(Request $request){

        $get_last_code = ProfileLibTblAreaCode::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }
                
        ProfileLibTblAreaCode::create([
            'CODE' => $latest_code,
            'NAME' =>  $request->NAME,
            'ZIPCODE' => $request->ZIPCODE,
        ]);

        return 'Successfully added';
    }

    public function getCityMunicipality(Request $request){
        $CityMunicipality = ProfileLibTblAreaCode::all();

        return $CityMunicipality;
    }

    public function addDegree(Request $request){

        $get_last_code = ProfileLibTblEducDegree::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        ProfileLibTblEducDegree::create([
            'CODE' => $latest_code,
            'DEGREE' =>  $request->DEGREE,
        ]);

        return 'Successfully added';
    }

    public function getDegree(Request $request){
        $Degree = ProfileLibTblEducDegree::all();

        return $Degree;
    }

    public function addCourseMajor(Request $request){

        $get_last_code = ProfileLibTblEducMajor::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        ProfileLibTblEducMajor::create([
            'CODE' => $latest_code,
            'COURSE' =>  $request->COURSE,
        ]);

        return 'Successfully added';
    }

    public function getCourseMajor(Request $request){
        $CourseMajor = ProfileLibTblEducMajor::all();

        return $CourseMajor;
    }

    public function addSchool(Request $request){

        $get_last_code = ProfileLibTblEducSchool::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        ProfileLibTblEducSchool::create([
            'CODE' => $latest_code,
            'SCHOOL' =>  $request->SCHOOL,
        ]);
        
        return 'Successfully added';
    }

    public function getSchool(Request $request){
        $School = ProfileLibTblEducSchool::all();

        return $School;
    }

    public function addExaminationReference(Request $request){
        ProfileLibTblExamRef::create([
            'CODE' => $request->CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getExaminationReference(Request $request){
        $ExaminationReference = ProfileLibTblExamRef::all();

        return $ExaminationReference;
    }

    public function addLanguageDialects(Request $request){
        ProfileLibTblLanguageRef::create([
            'code' => $request->code,
            'title' =>  $request->title,
        ]);
        return 'Successfully added';
    }

    public function getLanguageDialects(Request $request){
        $LanguageDialects = ProfileLibTblLanguageRef::all();

        return $LanguageDialects;
    }

    public function addCesStatusReference(Request $request){
        ProfileLibTblCesStatus::create([
            'code' => $request->code,
            'description' =>  $request->title,
        ]);
        return 'Successfully added';
    }

    public function getCesStatusReference(Request $request){
        $CesStatusReference = ProfileLibTblCesStatus::all();

        return $CesStatusReference;
    }

    public function addAcquiredThru(Request $request){
        ProfileLibTblCesStatusAcc::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getAcquiredThru(Request $request){
        $AcquiredThru = ProfileLibTblCesStatusAcc::all();

        return $AcquiredThru;
    }

    public function addStatusType(Request $request){
        ProfileLibTblCesStatusType::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getStatusType(Request $request){
        $StatusType = ProfileLibTblCesStatusType::all();

        return $StatusType;
    }

    public function addAppointingAuthority(Request $request){
        ProfileLibTblAppAuthority::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getAppointingAuthority(Request $request){
        $AppointingAuthority = ProfileLibTblAppAuthority::all();

        return $AppointingAuthority;
    }

    public function addExpertiseCategory(Request $request){
        ProfileLibTblExpertiseGen::create([
            'GenExp_Code' => $request->GenExp_Code,
            'Title' =>  $request->Title,
        ]);
        return 'Successfully added';
    }

    public function getExpertiseCategory(Request $request){
        $ExpertiseCategory = ProfileLibTblExpertiseGen::all();

        return $ExpertiseCategory;
    }

    public function addSpecialSkill(Request $request){
        ProfileLibTblExpertiseSpec::create([
            'SpeExp_Code' => $request->SpeExp_Code,
            'Title' =>  $request->Title,
        ]);
        return 'Successfully added';
    }

    public function getSpecialSkill(Request $request){
        $SpecialSkill = ProfileLibTblExpertiseSpec::all();

        return $SpecialSkill;
    }

    public function addCaseNature(Request $request){
        ProfileLibTblCaseNature::create([
            'STATUS_CODE' => $request->STATUS_CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getCaseNature(Request $request){
        $CaseNature = ProfileLibTblCaseNature::all();

        return $CaseNature;
    }

    public function addCaseStatus(Request $request){
        ProfileLibTblCaseStatus::create([
            'STATUS_CODE' => $request->STATUS_CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getCaseStatus(Request $request){
        $CaseStatus = ProfileLibTblCaseStatus::all();

        return $CaseStatus;
    }

    public function addLocationCity(Request $request){
        ProfileLibTblCities::create([
            'city_code' => $request->city_code,
            'prov_code' =>  $request->prov_code,
            'name' =>  $request->name,
            'zipcode' =>  $request->zipcode,
        ]);
        return 'Successfully added';
    }

    public function getLocationCity(Request $request){
        $LocationCity = ProfileLibTblCities::all();

        return $LocationCity;
    }

    public function addLocationProvince(Request $request){
        ProfileLibTblProvince::create([
            'prov_code' => $request->prov_code,
            'reg_code' =>  $request->reg_code,
            'name' =>  $request->name,
            'zipcode' =>  $request->zipcode,
        ]);
        return 'Successfully added';
    }

    public function getLocationProvince(Request $request){
        $LocationProvince = ProfileLibTblProvince::all();

        return $LocationProvince;
    }

    public function addLocationRegion(Request $request){
        ProfileLibTblRegion::create([
            'reg_code' => $request->reg_code,
            'name' =>  $request->name,
            'acronym' =>  $request->acronym,
            'zipcode' =>  $request->zipcode,
            'regionSeq' =>  $request->regionSeq,
        ]);
        return 'Successfully added';
    }

    public function getLocationRegion(Request $request){
        $LocationRegion = ProfileLibTblRegion::all();

        return $LocationRegion;
    }
}
