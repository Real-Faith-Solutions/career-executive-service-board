<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profilelib_tblareacode;
use App\Models\profilelib_tblEducDegree;
use App\Models\profilelib_tblEducMajor;
use App\Models\profilelib_tblEducSchools;
use App\Models\profilelib_tblExamRef;
use App\Models\profilelib_tblLanguageRef;
use App\Models\profilelib_tblcesstatus;
use App\Models\profilelib_tblcesstatusAcc;
use App\Models\profilelib_tblcesstatustype;
use App\Models\profilelib_tblappAuthority;
use App\Models\profilelib_tblExpertiseGen;
use App\Models\profilelib_tblExpertiseSpec;
use App\Models\profilelib_tblCaseNature;
use App\Models\profilelib_tblCaseStatus;
use App\Models\profilelib_tblcities;
use App\Models\profilelib_tblprovince;
use App\Models\profilelib_tblregion;


class LibraryController extends Controller
{
    public function index(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('System Utility') == 'true'){

            $CityMunicipality = profilelib_tblareacode::orderBy('created_at', 'desc')->get();
            $Degree = profilelib_tblEducDegree::orderBy('created_at', 'desc')->get();
            $CourseMajor = profilelib_tblEducMajor::orderBy('created_at', 'desc')->get();
            $School = profilelib_tblEducSchools::orderBy('created_at', 'desc')->get();
            $ExaminationReference = profilelib_tblExamRef::orderBy('created_at', 'desc')->get();
            $LanguageDialects = profilelib_tblLanguageRef::orderBy('created_at', 'desc')->get();
            $CesStatusReference = profilelib_tblcesstatus::orderBy('created_at', 'desc')->get();
            $AcquiredThru = profilelib_tblcesstatusAcc::orderBy('created_at', 'desc')->get();
            $StatusType = profilelib_tblcesstatustype::orderBy('created_at', 'desc')->get();
            $AppointingAuthority = profilelib_tblappAuthority::orderBy('created_at', 'desc')->get();
            $ExpertiseCategory = profilelib_tblExpertiseGen::orderBy('created_at', 'desc')->get();
            $SpecialSkill = profilelib_tblExpertiseSpec::orderBy('created_at', 'desc')->get();
            $CaseNature = profilelib_tblCaseNature::orderBy('created_at', 'desc')->get();
            $CaseStatus = profilelib_tblCaseStatus::orderBy('created_at', 'desc')->get();
            $LocationCity = profilelib_tblcities::orderBy('created_at', 'desc')->get();
            $LocationProvince = profilelib_tblprovince::orderBy('created_at', 'desc')->get();
            $LocationRegion = profilelib_tblregion::orderBy('created_at', 'desc')->get();
            // dd($CityMunicipality);
            return view('admin.201_library.index', compact('CityMunicipality','Degree','CourseMajor','School','ExaminationReference','LanguageDialects','CesStatusReference',
            'AcquiredThru','StatusType','AppointingAuthority','ExpertiseCategory','SpecialSkill','CaseNature','CaseStatus','LocationCity','LocationProvince','LocationRegion'))->render();

        }
        else{

            return view('restricted');
        }
        
    }

    public function addCityMunicipality(Request $request){

        $get_last_code = profilelib_tblareacode::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }
                
        profilelib_tblareacode::create([
            'CODE' => $latest_code,
            'NAME' =>  $request->NAME,
            'ZIPCODE' => $request->ZIPCODE,
        ]);

        return 'Successfully added';
    }

    public function getCityMunicipality(Request $request){
        $CityMunicipality = profilelib_tblareacode::all();

        return $CityMunicipality;
    }

    public function addDegree(Request $request){

        $get_last_code = profilelib_tblEducDegree::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        profilelib_tblEducDegree::create([
            'CODE' => $latest_code,
            'DEGREE' =>  $request->DEGREE,
        ]);

        return 'Successfully added';
    }

    public function getDegree(Request $request){
        $Degree = profilelib_tblEducDegree::all();

        return $Degree;
    }

    public function addCourseMajor(Request $request){

        $get_last_code = profilelib_tblEducMajor::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        profilelib_tblEducMajor::create([
            'CODE' => $latest_code,
            'COURSE' =>  $request->COURSE,
        ]);

        return 'Successfully added';
    }

    public function getCourseMajor(Request $request){
        $CourseMajor = profilelib_tblEducMajor::all();

        return $CourseMajor;
    }

    public function addSchool(Request $request){

        $get_last_code = profilelib_tblEducSchools::select('CODE')->get()->max();

        if($get_last_code == null){

            $latest_code = 1;
        }
        else{

            $latest_code = ($get_last_code->CODE + 1);
        }

        profilelib_tblEducSchools::create([
            'CODE' => $latest_code,
            'SCHOOL' =>  $request->SCHOOL,
        ]);
        
        return 'Successfully added';
    }

    public function getSchool(Request $request){
        $School = profilelib_tblEducSchools::all();

        return $School;
    }

    public function addExaminationReference(Request $request){
        profilelib_tblExamRef::create([
            'CODE' => $request->CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getExaminationReference(Request $request){
        $ExaminationReference = profilelib_tblExamRef::all();

        return $ExaminationReference;
    }

    public function addLanguageDialects(Request $request){
        profilelib_tblLanguageRef::create([
            'code' => $request->code,
            'title' =>  $request->title,
        ]);
        return 'Successfully added';
    }

    public function getLanguageDialects(Request $request){
        $LanguageDialects = profilelib_tblLanguageRef::all();

        return $LanguageDialects;
    }

    public function addCesStatusReference(Request $request){
        profilelib_tblcesstatus::create([
            'code' => $request->code,
            'description' =>  $request->title,
        ]);
        return 'Successfully added';
    }

    public function getCesStatusReference(Request $request){
        $CesStatusReference = profilelib_tblcesstatus::all();

        return $CesStatusReference;
    }

    public function addAcquiredThru(Request $request){
        profilelib_tblcesstatusAcc::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getAcquiredThru(Request $request){
        $AcquiredThru = profilelib_tblcesstatusAcc::all();

        return $AcquiredThru;
    }

    public function addStatusType(Request $request){
        profilelib_tblcesstatustype::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getStatusType(Request $request){
        $StatusType = profilelib_tblcesstatustype::all();

        return $StatusType;
    }

    public function addAppointingAuthority(Request $request){
        profilelib_tblappAuthority::create([
            'code' => $request->code,
            'description' =>  $request->description,
        ]);
        return 'Successfully added';
    }

    public function getAppointingAuthority(Request $request){
        $AppointingAuthority = profilelib_tblappAuthority::all();

        return $AppointingAuthority;
    }

    public function addExpertiseCategory(Request $request){
        profilelib_tblExpertiseGen::create([
            'GenExp_Code' => $request->GenExp_Code,
            'Title' =>  $request->Title,
        ]);
        return 'Successfully added';
    }

    public function getExpertiseCategory(Request $request){
        $ExpertiseCategory = profilelib_tblExpertiseGen::all();

        return $ExpertiseCategory;
    }

    public function addSpecialSkill(Request $request){
        profilelib_tblExpertiseSpec::create([
            'SpeExp_Code' => $request->SpeExp_Code,
            'Title' =>  $request->Title,
        ]);
        return 'Successfully added';
    }

    public function getSpecialSkill(Request $request){
        $SpecialSkill = profilelib_tblExpertiseSpec::all();

        return $SpecialSkill;
    }

    public function addCaseNature(Request $request){
        profilelib_tblCaseNature::create([
            'STATUS_CODE' => $request->STATUS_CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getCaseNature(Request $request){
        $CaseNature = profilelib_tblCaseNature::all();

        return $CaseNature;
    }

    public function addCaseStatus(Request $request){
        profilelib_tblCaseStatus::create([
            'STATUS_CODE' => $request->STATUS_CODE,
            'TITLE' =>  $request->TITLE,
        ]);
        return 'Successfully added';
    }

    public function getCaseStatus(Request $request){
        $CaseStatus = profilelib_tblCaseStatus::all();

        return $CaseStatus;
    }

    public function addLocationCity(Request $request){
        profilelib_tblcities::create([
            'city_code' => $request->city_code,
            'prov_code' =>  $request->prov_code,
            'name' =>  $request->name,
            'zipcode' =>  $request->zipcode,
        ]);
        return 'Successfully added';
    }

    public function getLocationCity(Request $request){
        $LocationCity = profilelib_tblcities::all();

        return $LocationCity;
    }

    public function addLocationProvince(Request $request){
        profilelib_tblprovince::create([
            'prov_code' => $request->prov_code,
            'reg_code' =>  $request->reg_code,
            'name' =>  $request->name,
            'zipcode' =>  $request->zipcode,
        ]);
        return 'Successfully added';
    }

    public function getLocationProvince(Request $request){
        $LocationProvince = profilelib_tblprovince::all();

        return $LocationProvince;
    }

    public function addLocationRegion(Request $request){
        profilelib_tblregion::create([
            'reg_code' => $request->reg_code,
            'name' =>  $request->name,
            'acronym' =>  $request->acronym,
            'zipcode' =>  $request->zipcode,
            'regionSeq' =>  $request->regionSeq,
        ]);
        return 'Successfully added';
    }

    public function getLocationRegion(Request $request){
        $LocationRegion = profilelib_tblregion::all();

        return $LocationRegion;
    }
}
