<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatedNewAccountMail;

use App\Models\PersonalData;
use App\Models\SpouseRecords;
use App\Models\FamilyProfile;
use App\Models\Addresses;
use App\Models\EducationalAttainment;
use App\Models\ExaminationsTaken;
use App\Models\CesStatus;
use App\Models\LanguagesDialects;
use App\Models\WorkExperience;
use App\Models\FieldExpertise;
use App\Models\CesTrainings;
use App\Models\OtherManagementTrainings;
use App\Models\ResearchAndStudies;
use App\Models\Scholarships;
use App\Models\Affiliations;
use App\Models\AwardAndCitations;
use App\Models\CaseRecords;
use App\Models\HealthRecords;
use App\Models\ChildrenRecords;
use App\Models\HomePermanentAddress;
use App\Models\LicenseDetails;
use App\Models\MailingAddress;
use App\Models\CesWe;
use App\Models\AssessmentCenter;
use App\Models\ValidationHr;
use App\Models\BoardInterview;
use App\Models\RecordOfCespesRatings;
use App\Models\HistoricalRecordOfMedicalCondition;
use App\Models\User;
use App\Models\PdfLinks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
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

class ProfileController extends Controller
{

    public function validateData($type, $value){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            if($type == 'email'){

                // Validate value

                $validator = Validator::make(
                        
                    array(
                        'oea_ma' => $value,
                    ),
                    array(
                        'oea_ma' => 'email|max:255',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{

                    $search_email_201_profile = PersonalData::where('oea_ma','=',$value)->get();
                    $search_email_user = User::where('email','=',$value)->get();

                    if($search_email_201_profile == '[]' && $search_email_user == '[]'){

                        $validation_result = 'false';

                        return $validation_result;
                    }
                    else{

                        $PersonalData = PersonalData::where('oea_ma','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                        $User = User::where('email','=',$value)->select('role','last_name','first_name','middle_name')->get();

                        return compact('PersonalData','User');
                    }
                }
            }
            else if($type == 'gsis id'){

                $search_gsis_201_profile = PersonalData::where('gsis','=',$value)->get();

                if($search_gsis_201_profile == '[]'){

                    $validation_result = 'false';

                    return $validation_result;
                }
                else{

                    $PersonalData = PersonalData::where('gsis','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                    $User = ''; // Set empty $User variable to be use in "validateData" function java script

                    return compact('PersonalData', 'User');
                }

            }
            else if($type == 'pagibig id'){

                $search_pagibig_201_profile = PersonalData::where('pagibig','=',$value)->get();

                if($search_pagibig_201_profile == '[]'){

                    $validation_result = 'false';

                    return $validation_result;
                }
                else{

                    $PersonalData = PersonalData::where('pagibig','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                    $User = ''; // Set empty $User variable to be use in "validateData" function java script

                    return compact('PersonalData', 'User');
                }

            }
            else if($type == 'philhealth id'){

                $search_philhealt_201_profile = PersonalData::where('philhealt','=',$value)->get();

                if($search_philhealt_201_profile == '[]'){

                    $validation_result = 'false';

                    return $validation_result;
                }
                else{

                    $PersonalData = PersonalData::where('philhealt','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                    $User = ''; // Set empty $User variable to be use in "validateData" function java script

                    return compact('PersonalData', 'User');
                }

            }
            else if($type == 'sss id'){

                $search_sss_no_201_profile = PersonalData::where('sss_no','=',$value)->get();

                if($search_sss_no_201_profile == '[]'){

                    $validation_result = 'false';

                    return $validation_result;
                }
                else{

                    $PersonalData = PersonalData::where('sss_no','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                    $User = ''; // Set empty $User variable to be use in "validateData" function java script

                    return compact('PersonalData', 'User');
                }

            }
            else if($type == 'tin id'){

                $search_tin_201_profile = PersonalData::where('tin','=',$value)->get();

                if($search_tin_201_profile == '[]'){

                    $validation_result = 'false';

                    return $validation_result;
                }
                else{

                    $PersonalData = PersonalData::where('tin','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                    $User = ''; // Set empty $User variable to be use in "validateData" function java script

                    return compact('PersonalData', 'User');
                }

            }
            else if($type == 'mobile no. 1'){

                // Validate value

                $validator = Validator::make(
                        
                    array(
                        'mobileno1_ma' => $value,
                    ),
                    array(
                        'mobileno1_ma' => 'regex:/^([+][63])[\d]{11}$/',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{

                    $search_mobileno1_ma_201_profile = PersonalData::where('mobileno1_ma','=',$value)->get();

                    if($search_mobileno1_ma_201_profile == '[]'){

                        $validation_result = 'false';

                        return $validation_result;
                    }
                    else{

                        $PersonalData = PersonalData::where('mobileno1_ma','=',$value)->select('cesno','lastname','firstname','middlename')->get();
                        $User = ''; // Set empty $User variable to be use in "validateData" function java script

                        return compact('PersonalData', 'User');
                    }
                }

            }
        }
        else{

            return 'Restricted';
        }
    }

    public function validate201Profile($lastname, $firstname, $middlename, $birthdate){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            $search_201_profile_by_name = PersonalData::where('lastname','like',"%$lastname%")->where('firstname','like',"%$firstname%")->where('middlename','like',"%$middlename%")->get();
            $search_201_profile_by_name_and_birthday = PersonalData::where('lastname','like',"%$lastname%")->where('firstname','like',"%$firstname%")->where('middlename','like',"%$middlename%")->where('birthdate','=',$birthdate)->get();

            if($search_201_profile_by_name == '[]' && $search_201_profile_by_name_and_birthday == '[]'){

                $validation_result = 'false';

                return $validation_result;
            }
            else{

                $validate_by_name = PersonalData::where('lastname','like',"%$lastname%")->where('firstname','like',"%$firstname%")->where('middlename','like',"%$middlename%")->select('cesno','lastname','firstname','middlename')->get();
                $validate_by_name_and_birthday = PersonalData::where('lastname','like',"%$lastname%")->where('firstname','like',"%$firstname%")->where('middlename','like',"%$middlename%")->where('birthdate','=',$birthdate)->select('cesno','lastname','firstname','middlename')->get();

                return compact('validate_by_name','validate_by_name_and_birthday');
            }
        }
        else{

            return 'Restricted';
        }
    }

    public static function latestCesNo(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            $cesLastNoID = PersonalData::select('cesno')->get()->max();

            if($cesLastNoID == null){

                return 1;
            }
            else{

                return ($cesLastNoID->cesno + 1);
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function add201ProfilePage(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            $personalData = PersonalData::offset(0)->limit(50)->orderBy('cesno','desc')->get();
            $latestCesNo = ProfileController::latestCesNo();

            return view('admin.add_view_edit_201_profile', compact('latestCesNo', 'personalData'))->render();
        }
        else{

            return view('restricted');
        }
 
    }

    public function view201ProfilePage($cesno, $numberOfResult = 50){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            if(ProfileController::latestCesNo() == 1){

                return Redirect::to('/admin/profile/add');
            }
            else{

                $personalData = PersonalData::where('cesno','=',$cesno)->get();
                $HomePermanentAddress = HomePermanentAddress::where('cesno','=',$cesno)->get();
                $MailingAddress = MailingAddress::where('cesno','=',$cesno)->get();
                $SpouseRecords = SpouseRecords::where('cesno','=',$cesno)->get();
                $FamilyProfile = FamilyProfile::where('cesno','=',$cesno)->get();
                $ChildrenRecords = ChildrenRecords::where('cesno','=',$cesno)->get();
                $EducationalAttainment = EducationalAttainment::where('cesno','=',$cesno)->get();
                $ExaminationsTaken = ExaminationsTaken::where('cesno','=',$cesno)->get();
                $LicenseDetails = LicenseDetails::where('cesno','=',$cesno)->get();
                $LanguagesDialects = LanguagesDialects::where('cesno','=',$cesno)->get();
                $CesWe = CesWe::where('cesno','=',$cesno)->get();
                $AssessmentCenter = AssessmentCenter::where('cesno','=',$cesno)->get();
                $ValidationHr = ValidationHr::where('cesno','=',$cesno)->get();
                $BoardInterview = BoardInterview::where('cesno','=',$cesno)->get();
                $CesStatus = CesStatus::where('cesno','=',$cesno)->get();
                $RecordOfCespesRatings = RecordOfCespesRatings::where('cesno','=',$cesno)->get();
                $WorkExperience = WorkExperience::where('cesno','=',$cesno)->get();
                $FieldExpertise = FieldExpertise::where('cesno','=',$cesno)->get();
                $CesTrainings = CesTrainings::where('cesno','=',$cesno)->get();
                $OtherManagementTrainings = OtherManagementTrainings::where('cesno','=',$cesno)->get();
                $ResearchAndStudies = ResearchAndStudies::where('cesno','=',$cesno)->get();
                $Scholarships = Scholarships::where('cesno','=',$cesno)->get();
                $Affiliations = Affiliations::where('cesno','=',$cesno)->get();
                $AwardAndCitations = AwardAndCitations::where('cesno','=',$cesno)->get();
                $CaseRecords = CaseRecords::where('cesno','=',$cesno)->get();
                $HealthRecords = HealthRecords::where('cesno','=',$cesno)->get();
                $HistoricalRecordOfMedicalCondition = HistoricalRecordOfMedicalCondition::where('cesno','=',$cesno)->get();
                $PdfLinks = PdfLinks::where('cesno','=',$cesno)->get();

                $searched = PersonalData::offset(0)->limit($numberOfResult)->get();

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

                
                return view('admin.add_view_edit_201_profile', compact('searched', 'personalData','HomePermanentAddress','MailingAddress','SpouseRecords','FamilyProfile','ChildrenRecords','EducationalAttainment','ExaminationsTaken','LicenseDetails','LanguagesDialects',
                'CesWe','AssessmentCenter','ValidationHr','BoardInterview','CesStatus','RecordOfCespesRatings','WorkExperience','FieldExpertise','CesTrainings','OtherManagementTrainings',
                'ResearchAndStudies','Scholarships','Affiliations','AwardAndCitations','CaseRecords','HealthRecords','HistoricalRecordOfMedicalCondition','PdfLinks','CityMunicipality','Degree','CourseMajor','School','ExaminationReference','LanguageDialects','CesStatusReference',
                'AcquiredThru','StatusType','AppointingAuthority','ExpertiseCategory','SpecialSkill','CaseNature','CaseStatus','LocationCity','LocationProvince','LocationRegion'))->render();
            }
        }
        else{

            return view('restricted');
        }
    }

    public function addPersonalData(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'sp' =>  $request->sp,
                    'moig' => $request->moig,
                    'pwd_CheckB' => $request->pwd_CheckB,
                    'pwd' => $request->pwd,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealt' => $request->philhealt,
                    'sss_no' => $request->sss_no,
                    'tin' => $request->tin,
                    'status' => $request->status,
                    'citizenship' => $request->citizenship,
                    'd_citizenship' => $request->d_citizenship,
                    'ne' => $request->ne,
                    'title' => $request->title,
                    'picture' => $request->picture,
                    'lastname' => $request->lastname,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'mi' => $request->mi,
                    'nickname' => $request->nickname,
                    'birthdate' => $request->birthdate,
                    // 'age' => $request->age,
                    'birth_place' => $request->birth_place,
                    'gender' => $request->gender,
                    'civil_status' => $request->civil_status,
                    'religion' => $request->religion,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'fb_pa' => $request->fb_pa,
                    'ns_pa' => $request->ns_pa,
                    'bd_pa' => $request->bd_pa,
                    'cm_pa' => $request->cm_pa,
                    'zc_pa' => $request->zc_pa,
                    'fb_ma' => $request->fb_ma,
                    'ns_ma' => $request->ns_ma,
                    'bd_ma' => $request->bd_ma,
                    'cm_ma' => $request->cm_ma,
                    'zc_ma' => $request->zc_ma,
                    'oea_ma' => $request->oea_ma,
                    'mobileno1_ma' => $request->mobileno1_ma,
                    'telno1_ma' => $request->telno1_ma,
                    'mobileno2_ma' => $request->mobileno2_ma,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ),
                array(
                    'cesno' => 'required|unique:personal_data,cesno',
                    'sp' =>  'required',
                    'moig' => 'required',
                    'pwd_CheckB' => 'required_with:pwd',
                    'pwd' => 'required_with:pwd_CheckB',
                    'gsis' => 'required|unique:personal_data,gsis|max:255',
                    'pagibig' => 'required|unique:personal_data,pagibig|max:255',
                    'philhealt' => 'required|unique:personal_data,philhealt|max:255',
                    'sss_no' => 'max:255',
                    'tin' => 'max:255',
                    'status' => 'required',
                    'citizenship' => 'required',
                    'd_citizenship' => 'required_if:citizenship,Dual Citizenship|max:255',
                    'ne' => '',
                    'title' => 'required',
                    'picture' => (($request->picture == null) ? '' : 'mimes:jpeg,png|file|max:2048|dimensions:min_width=300,min_height=300'),
                    'lastname' => 'required|max:255',
                    'firstname' => 'required|max:255',
                    'middlename' => 'required|min:2',
                    'mi' => 'required|max:1',
                    'nickname' => 'max:255',
                    'birthdate' => 'required|date',
                    // 'age' => 'required|integer',
                    'birth_place' => 'max:255',
                    'gender' => 'required',
                    'civil_status' => 'required',
                    'religion' => 'required|max:255',
                    'height' => 'max:255',
                    'weight' => 'max:255',
                    'fb_pa' => 'max:255',
                    'ns_pa' => 'max:255',
                    'bd_pa' => 'required|max:255',
                    'cm_pa' => 'required|max:255',
                    'zc_pa' => 'required|max:255',
                    'fb_ma' => 'max:255',
                    'ns_ma' => 'max:255',
                    'bd_ma' => 'required|max:255',
                    'cm_ma' => 'required|max:255',
                    'zc_ma' => 'required|max:255',
                    'oea_ma' => 'required|email|unique:personal_data,oea_ma|unique:users,email|max:255',
                    'mobileno1_ma' => ['required','unique:personal_data,mobileno1_ma','regex:/^([+][63])[\d]{11}$/'],
                    'telno1_ma' => ($request->telno1_ma != '' ? 'regex:/^([+][63])[\d]{9,11}$/' : ''),
                    'mobileno2_ma' => ($request->telno1_ma != '' ? 'regex:/^([+][63])[\d]{11}$/' : ''),
                    'last_updated_by' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                if($request->hasFile('picture')){

                    // Get file details

                    $filename_with_ext = $request->file('picture')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('picture')->getClientOriginalExtension();

                    Storage::disk('f-drive')->putFileAs('Photos/201 Photos/', $request->file('picture'), $request->cesno.'-'.$request->lastname.', '.$request->firstname.' '.$request->middlename.'.'.$extension);

                    $picture_file_name = $request->cesno.'-'.$request->lastname.', '.$request->firstname.' '.$request->middlename.'.'.$extension;

                }
                else{
                
                    $picture_file_name = '';  
                }   

                PersonalData::create([
                    'cesno' => $request->cesno,
                    'sp' =>  $request->sp,
                    'moig' => $request->moig,
                    'pwd' => $request->pwd,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealt' => $request->philhealt,
                    'sss_no' => $request->sss_no,
                    'tin' => $request->tin,
                    'status' => $request->status,
                    'citizenship' => $request->citizenship,
                    'd_citizenship' => $request->d_citizenship,
                    'ne' => $request->ne,
                    'title' => $request->title,
                    'picture' => $picture_file_name,
                    'lastname' => Str::ucfirst($request->lastname),
                    'firstname' => Str::ucfirst($request->firstname),
                    'middlename' => Str::ucfirst($request->middlename),
                    'mi' => Str::ucfirst($request->mi),
                    'nickname' => Str::ucfirst($request->nickname),
                    'birthdate' => $request->birthdate,
                    // 'age' => $request->age,
                    'birth_place' => Str::ucfirst($request->birth_place),
                    'gender' => $request->gender,
                    'civil_status' => $request->civil_status,
                    'religion' => Str::ucfirst($request->religion),
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'fb_pa' => Str::ucfirst($request->fb_pa),
                    'ns_pa' => Str::ucfirst($request->ns_pa),
                    'bd_pa' => Str::ucfirst($request->bd_pa),
                    'cm_pa' => Str::ucfirst($request->cm_pa),
                    'zc_pa' => $request->zc_pa,
                    'fb_ma' => Str::ucfirst($request->fb_ma),
                    'ns_ma' => Str::ucfirst($request->ns_ma),
                    'bd_ma' => Str::ucfirst($request->bd_ma),
                    'cm_ma' => Str::ucfirst($request->cm_ma),
                    'zc_ma' => $request->zc_ma,
                    'oea_ma' => $request->oea_ma,
                    'mobileno1_ma' => $request->mobileno1_ma,
                    'telno1_ma' => $request->telno1_ma,
                    'mobileno2_ma' => $request->mobileno2_ma,
                    'mailingaddr' => Str::ucfirst($request->fb_ma).', '.Str::ucfirst($request->ns_ma).', '.Str::ucfirst($request->bd_ma).', '.Str::ucfirst($request->cm_ma),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                // Generate 8 characters Random default password

                function secure_random_string($length) {

                    $random_string = '';

                    for($i = 0; $i < $length; $i++) {
                        $number = random_int(0, 36);
                        $character = base_convert($number, 10, 36);
                        $random_string .= $character;
                    }

                    return $random_string;
                }

                // Generated default password

                $random_password = secure_random_string(8);

                // Generate username for created 201 Profile

                $generated_username = Str::lower(Str::remove(' ', $request->lastname)).'user'.$request->cesno;

                // Create User Account for 201 Profile

                User::create([
                    'cesno' => $request->cesno,
                    'last_name' => Str::ucfirst($request->lastname),
                    'first_name' => Str::ucfirst($request->firstname),
                    'middle_name' => Str::ucfirst($request->middlename),
                    'contact_no' => $request->mobileno1_ma,
                    'email' => $request->oea_ma,
                    'employee_id' => 'None',
                    'username' => $generated_username,
                    'role' => 'User',
                    'role_name_no' => $request->cesno,
                    'password' => Hash::make($random_password),
                    'is_active' => $request->status,
                    'picture' => $picture_file_name,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);
        
                // Try and catch error on sending emails
        
                try{ 
        
                    Mail::to($request->oea_ma)->send(new CreatedNewAccountMail($random_password, $generated_username));
                }
                catch (\exception $e){
                    
                    // Report an exception via the exception handler without rendering an error page to the user
                    
                    report($e);
                }
        
                return 'Successfully added';

            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editPersonalData(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'sp' =>  $request->sp,
                    'moig' => $request->moig,
                    'pwd_CheckB' => $request->pwd_CheckB,
                    'pwd' => $request->pwd,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealt' => $request->philhealt,
                    'sss_no' => $request->sss_no,
                    'tin' => $request->tin,
                    'status' => $request->status,
                    'citizenship' => $request->citizenship,
                    'd_citizenship' => $request->d_citizenship,
                    'ne' => $request->ne,
                    'title' => $request->title,
                    'picture' => $request->picture,
                    'lastname' => $request->lastname,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'mi' => $request->mi,
                    'nickname' => $request->nickname,
                    'birthdate' => $request->birthdate,
                    // 'age' => $request->age,
                    'birth_place' => $request->birth_place,
                    'gender' => $request->gender,
                    'civil_status' => $request->civil_status,
                    'religion' => $request->religion,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'fb_pa' => $request->fb_pa,
                    'ns_pa' => $request->ns_pa,
                    'bd_pa' => $request->bd_pa,
                    'cm_pa' => $request->cm_pa,
                    'zc_pa' => $request->zc_pa,
                    'fb_ma' => $request->fb_ma,
                    'ns_ma' => $request->ns_ma,
                    'bd_ma' => $request->bd_ma,
                    'cm_ma' => $request->cm_ma,
                    'zc_ma' => $request->zc_ma,
                    'oea_ma' => $request->oea_ma,
                    'mobileno1_ma' => $request->mobileno1_ma,
                    'telno1_ma' => $request->telno1_ma,
                    'mobileno2_ma' => $request->mobileno2_ma,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ),
                array(
                    'sp' =>  'required',
                    'moig' => 'required',
                    'pwd_CheckB' => 'required_with:pwd',
                    'pwd' => 'required_with:pwd_CheckB',
                    'gsis' => 'required|max:255',
                    'pagibig' => 'required|max:255',
                    'philhealt' => 'required|max:255',
                    'sss_no' => 'max:255',
                    'tin' => 'max:255',
                    'status' => 'required',
                    'citizenship' => 'required',
                    'd_citizenship' => 'required_if:citizenship,Dual Citizenship|max:255',
                    'ne' => '',
                    'title' => 'required',
                    'picture' => (($request->picture == null) ? '' : 'mimes:jpeg,png|file|max:2048|dimensions:min_width=300,min_height=300'),
                    'lastname' => 'required|max:255',
                    'firstname' => 'required|max:255',
                    'middlename' => 'required|min:2',
                    'mi' => 'required|max:1',
                    'nickname' => 'max:255',
                    'birthdate' => 'required|date',
                    // 'age' => 'required|integer',
                    'birth_place' => 'max:255',
                    'gender' => 'required',
                    'civil_status' => 'required',
                    'religion' => 'required|max:255',
                    'height' => 'max:255',
                    'weight' => 'max:255',
                    'fb_pa' => 'max:255',
                    'ns_pa' => 'max:255',
                    'bd_pa' => 'required|max:255',
                    'cm_pa' => 'required|max:255',
                    'zc_pa' => 'required|max:255',
                    'fb_ma' => 'max:255',
                    'ns_ma' => 'max:255',
                    'bd_ma' => 'required|max:255',
                    'cm_ma' => 'required|max:255',
                    'zc_ma' => 'required|max:255',
                    'oea_ma' => 'required|email|max:255',
                    'mobileno1_ma' => ['required','regex:/^([+][63])[\d]{11}$/'],
                    'telno1_ma' => ($request->telno1_ma != '' ? 'regex:/^([+][63])[\d]{9,11}$/' : ''),
                    'mobileno2_ma' => ($request->telno1_ma != '' ? 'regex:/^([+][63])[\d]{11}$/' : ''),
                    'last_updated_by' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                // Get User current 2x2 Photo file name

                $PersonalData = PersonalData::where('cesno','=',$request->cesno)->get();
                $PersonalData_picture_file_name = $PersonalData[0]->picture;

                if($request->hasFile('picture')){

                    // Get file details

                    $filename_with_ext = $request->file('picture')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('picture')->getClientOriginalExtension();

                    // Delete User current 2x2 Photo

                    if(Storage::disk('f-drive')->exists('Photos/201 Photos/'.$PersonalData_picture_file_name)){

                        Storage::disk('f-drive')->delete('Photos/201 Photos/'.$PersonalData_picture_file_name);
                    }

                    // Save User new 2x2 Photo

                    Storage::disk('f-drive')->putFileAs('Photos/201 Photos/', $request->file('picture'), $request->cesno.'-'.$request->lastname.', '.$request->firstname.' '.$request->middlename.'.'.$extension);

                    $picture_file_name = $request->cesno.'-'.$request->lastname.', '.$request->firstname.' '.$request->middlename.'.'.$extension;

                }
                else{
                
                    $picture_file_name = $PersonalData_picture_file_name;  
                }   

                PersonalData::where('cesno', $request->cesno)
                    ->update([
                    // 'cesno' => $request->cesno,
                    'sp' =>  $request->sp,
                    'moig' => $request->moig,
                    'pwd' => $request->pwd,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealt' => $request->philhealt,
                    'sss_no' => $request->sss_no,
                    'tin' => $request->tin,
                    'status' => $request->status,
                    'citizenship' => $request->citizenship,
                    'd_citizenship' => $request->d_citizenship,
                    'ne' => $request->ne,
                    'title' => $request->title,
                    'picture' => $picture_file_name,
                    'lastname' => Str::ucfirst($request->lastname),
                    'firstname' => Str::ucfirst($request->firstname),
                    'middlename' => Str::ucfirst($request->middlename),
                    'mi' => Str::ucfirst($request->mi),
                    'nickname' => Str::ucfirst($request->nickname),
                    'birthdate' => $request->birthdate,
                    // 'age' => $request->age,
                    'birth_place' => Str::ucfirst($request->birth_place),
                    'gender' => $request->gender,
                    'civil_status' => $request->civil_status,
                    'religion' => Str::ucfirst($request->religion),
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'fb_pa' => Str::ucfirst($request->fb_pa),
                    'ns_pa' => Str::ucfirst($request->ns_pa),
                    'bd_pa' => Str::ucfirst($request->bd_pa),
                    'cm_pa' => Str::ucfirst($request->cm_pa),
                    'zc_pa' => $request->zc_pa,
                    'fb_ma' => Str::ucfirst($request->fb_ma),
                    'ns_ma' => Str::ucfirst($request->ns_ma),
                    'bd_ma' => Str::ucfirst($request->bd_ma),
                    'cm_ma' => Str::ucfirst($request->cm_ma),
                    'zc_ma' => $request->zc_ma,
                    'oea_ma' => $request->oea_ma,
                    'mobileno1_ma' => $request->mobileno1_ma,
                    'telno1_ma' => $request->telno1_ma,
                    'mobileno2_ma' => $request->mobileno2_ma,
                    'mailingaddr' => Str::ucfirst($request->fb_ma).', '.Str::ucfirst($request->ns_ma).', '.Str::ucfirst($request->bd_ma).', '.Str::ucfirst($request->cm_ma),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                User::where('cesno', $request->cesno)
                    ->update([
                    'cesno' => $request->cesno,
                    'last_name' => Str::ucfirst($request->lastname),
                    'first_name' => Str::ucfirst($request->firstname),
                    'middle_name' => Str::ucfirst($request->middlename),
                    'contact_no' => $request->mobileno1_ma,
                    'email' => $request->oea_ma,
                    // 'employee_id' => 'None',
                    // 'username' => Str::lower(Str::remove(' ', $request->lastname)).'user'.$request->cesno,
                    // 'role' => 'User',
                    'role_name_no' => $request->cesno,
                    // 'password' => Hash::make('Pa$$w0rd'),
                    'is_active' => $request->status,
                    'picture' => $picture_file_name,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getPersonalData($cesno){

        if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Category Only') == 'true'){

            $personaldata = PersonalData::where('cesno','=',$cesno)->get();

            return $personaldata;
        }
        else{

            return 'Restricted';
        }
        
    }

    // public function getAllPersonalData(){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Category Only') == 'true'){

    //         $personaldata = PersonalData::all();

    //         return $personaldata;
    //     }
    //     else{

    //         return 'Restricted';
    //     }
        
    // }

    // public function deletePersonalData($id){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Delete') == 'true'){

    //         $personaldata = PersonalData::where('id','=',$id)->get();

    //         if($personaldata == '[]'){

    //             $personaldata_cesno = '';
    //         }
    //         else{
                
    //             $personaldata_cesno = $personaldata[0]->cesno;
    //         }

    //         PersonalData::where('cesno','=',$personaldata_cesno)->delete();
    //         HomePermanentAddress::where('cesno','=',$personaldata_cesno)->delete();
    //         MailingAddress::where('cesno','=',$personaldata_cesno)->delete();
    //         SpouseRecords::where('cesno','=',$personaldata_cesno)->delete();
    //         FamilyProfile::where('cesno','=',$personaldata_cesno)->delete();
    //         ChildrenRecords::where('cesno','=',$personaldata_cesno)->delete();
    //         EducationalAttainment::where('cesno','=',$personaldata_cesno)->delete();
    //         ExaminationsTaken::where('cesno','=',$personaldata_cesno)->delete();
    //         LicenseDetails::where('cesno','=',$personaldata_cesno)->delete();
    //         LanguagesDialects::where('cesno','=',$personaldata_cesno)->delete();
    //         CesWe::where('cesno','=',$personaldata_cesno)->delete();
    //         AssessmentCenter::where('cesno','=',$personaldata_cesno)->delete();
    //         ValidationHr::where('cesno','=',$personaldata_cesno)->delete();
    //         BoardInterview::where('cesno','=',$personaldata_cesno)->delete();
    //         CesStatus::where('cesno','=',$personaldata_cesno)->delete();
    //         RecordOfCespesRatings::where('cesno','=',$personaldata_cesno)->delete();
    //         WorkExperience::where('cesno','=',$personaldata_cesno)->delete();
    //         FieldExpertise::where('cesno','=',$personaldata_cesno)->delete();
    //         CesTrainings::where('cesno','=',$personaldata_cesno)->delete();
    //         OtherManagementTrainings::where('cesno','=',$personaldata_cesno)->delete();
    //         ResearchAndStudies::where('cesno','=',$personaldata_cesno)->delete();
    //         Scholarships::where('cesno','=',$personaldata_cesno)->delete();
    //         Affiliations::where('cesno','=',$personaldata_cesno)->delete();
    //         AwardAndCitations::where('cesno','=',$personaldata_cesno)->delete();
    //         CaseRecords::where('cesno','=',$personaldata_cesno)->delete();
    //         HealthRecords::where('cesno','=',$personaldata_cesno)->delete();
    //         HistoricalRecordOfMedicalCondition::where('cesno','=',$personaldata_cesno)->delete();
    //         PdfLinks::where('cesno','=',$personaldata_cesno)->delete();
    //         User::where('cesno','=',$personaldata_cesno)->delete();

    //         return 'Successfully deleted';
    //     }
    //     else{

    //         return 'Restricted';
    //     }

    // }

    public function getCesnoID($request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            // Personal Data
            $PersonalData = PersonalData::where('cesno','=',$request)->get();
            $PersonalDataAdd = RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Add');
            $PersonalDataEdit = RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Edit');
            $PersonalDataDelete = RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Delete');
            $PersonalDataViewOnly = RolesController::validateUserExecutive201RoleAccess('Personal Data', 'View Only');

            // Disabled
            $HomePermanentAddress = HomePermanentAddress::where('cesno','=',$request)->get();
            $MailingAddress = MailingAddress::where('cesno','=',$request)->get();

            // Family Background Profile
            $SpouseRecords = SpouseRecords::where('cesno','=',$request)->get();
            $FamilyProfile = FamilyProfile::where('cesno','=',$request)->get();
            $ChildrenRecords = ChildrenRecords::where('cesno','=',$request)->get();
            $FamilyProfileAdd = RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add');
            $FamilyProfileEdit = RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit');
            $FamilyProfileDelete = RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Delete');
            $FamilyProfileViewOnly = RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'View Only');

            // Educational Background or Attainment
            $EducationalAttainment = EducationalAttainment::where('cesno','=',$request)->get();
            $EducationalAttainmentAdd = RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Add');
            $EducationalAttainmentEdit = RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Edit');
            $EducationalAttainmentDelete = RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Delete');
            $EducationalAttainmentViewOnly = RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'View Only');
            
            // Examinations Taken
            $ExaminationsTaken = ExaminationsTaken::where('cesno','=',$request)->get();
            $LicenseDetails = LicenseDetails::where('cesno','=',$request)->get();
            $ExaminationsTakenAdd = RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add');
            $ExaminationsTakenEdit = RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit');
            $ExaminationsTakenDelete = RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Delete');
            $ExaminationsTakenViewOnly = RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'View Only');

            // Language Dialects
            $LanguagesDialects = LanguagesDialects::where('cesno','=',$request)->get();
            $LanguagesDialectsAdd = RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Add');
            $LanguagesDialectsEdit = RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Edit');
            $LanguagesDialectsDelete = RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Delete');
            $LanguagesDialectsViewOnly = RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'View Only');

            // Eligibility and Rank Tracker
            $CesWe = CesWe::where('cesno','=',$request)->get();
            $AssessmentCenter = AssessmentCenter::where('cesno','=',$request)->get();
            $ValidationHr = ValidationHr::where('cesno','=',$request)->get();
            $BoardInterview = BoardInterview::where('cesno','=',$request)->get();
            $CesStatus = CesStatus::where('cesno','=',$request)->get();
            $EligibilityAndRankTrackerAdd = RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add');
            $EligibilityAndRankTrackerEdit = RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit');
            $EligibilityAndRankTrackerDelete = RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete');
            $EligibilityAndRankTrackerViewOnly = RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'View Only');

            // Record of CESPES Ratings
            $RecordOfCespesRatings = RecordOfCespesRatings::where('cesno','=',$request)->get();
            $RecordOfCespesRatingsAdd = RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Add');
            $RecordOfCespesRatingsEdit = RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Edit');
            $RecordOfCespesRatingsDelete = RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Delete');
            $RecordOfCespesRatingsViewOnly = RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'View Only');

            // Work Experience
            $WorkExperience = WorkExperience::where('cesno','=',$request)->get();
            $WorkExperienceAdd = RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Add');
            $WorkExperienceEdit = RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Edit');
            $WorkExperienceDelete = RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Delete');
            $WorkExperienceViewOnly = RolesController::validateUserExecutive201RoleAccess('Work Experience', 'View Only');

            // Records of Field of Expertise or Specialization
            $FieldExpertise = FieldExpertise::where('cesno','=',$request)->get();
            $FieldExpertiseAdd = RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Add');
            $FieldExpertiseEdit = RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Edit');
            $FieldExpertiseDelete = RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Delete');
            $FieldExpertiseViewOnly = RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'View Only');

            // CES Trainings
            $CesTrainings = CesTrainings::where('cesno','=',$request)->get();
            $CesTrainingsAdd = RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Add');
            $CesTrainingsEdit = RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Edit');
            $CesTrainingsDelete = RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Delete');
            $CesTrainingsViewOnly = RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'View Only');

            // Other Non-CES Accredited Trainings
            $OtherManagementTrainings = OtherManagementTrainings::where('cesno','=',$request)->get();
            $OtherManagementTrainingsAdd = RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Add');
            $OtherManagementTrainingsEdit = RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Edit');
            $OtherManagementTrainingsDelete = RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Delete');
            $OtherManagementTrainingsViewOnly = RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'View Only');

            // Research and Studies
            $ResearchAndStudies = ResearchAndStudies::where('cesno','=',$request)->get();
            $ResearchAndStudiesAdd = RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Add');
            $ResearchAndStudiesEdit = RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Edit');
            $ResearchAndStudiesDelete = RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Delete');
            $ResearchAndStudiesViewOnly = RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'View Only');

            // Scholarships Received
            $Scholarships = Scholarships::where('cesno','=',$request)->get();
            $ScholarshipsAdd = RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Add');
            $ScholarshipsEdit = RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Edit');
            $ScholarshipsDelete = RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Delete');
            $ScholarshipsViewOnly = RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'View Only');

            // Major Civic and Professional Affiliations
            $Affiliations = Affiliations::where('cesno','=',$request)->get();
            $AffiliationsAdd = RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Add');
            $AffiliationsEdit = RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Edit');
            $AffiliationsDelete = RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Delete');
            $AffiliationsViewOnly = RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'View Only');

            // Awards and Citations Received
            $AwardAndCitations = AwardAndCitations::where('cesno','=',$request)->get();
            $AwardAndCitationsAdd = RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Add');
            $AwardAndCitationsEdit = RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Edit');
            $AwardAndCitationsDelete = RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Delete');
            $AwardAndCitationsViewOnly = RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'View Only');

            // Case Records
            $CaseRecords = CaseRecords::where('cesno','=',$request)->get();
            $CaseRecordsAdd = RolesController::validateUserExecutive201RoleAccess('Case Records', 'Add');
            $CaseRecordsEdit = RolesController::validateUserExecutive201RoleAccess('Case Records', 'Edit');
            $CaseRecordsDelete = RolesController::validateUserExecutive201RoleAccess('Case Records', 'Delete');
            $CaseRecordsViewOnly = RolesController::validateUserExecutive201RoleAccess('Case Records', 'View Only');

            // Health Record
            $HealthRecords = HealthRecords::where('cesno','=',$request)->get();
            $HistoricalRecordOfMedicalCondition = HistoricalRecordOfMedicalCondition::where('cesno','=',$request)->get();
            $HealthRecordsAdd = RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add');
            $HealthRecordsEdit = RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit');
            $HealthRecordsDelete = RolesController::validateUserExecutive201RoleAccess('Health Record', 'Delete');
            $HealthRecordsViewOnly = RolesController::validateUserExecutive201RoleAccess('Health Record', 'View Only');

            // Attached PDF Files
            $PdfLinks = PdfLinks::where('cesno','=',$request)->get();
            $PdfLinksAdd = RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Add');
            $PdfLinksEdit = RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Edit');
            $PdfLinksDelete = RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Delete');
            $PdfLinksViewOnly = RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'View Only');

            $UserRoleName = Auth::user()->role;

            return compact('PersonalData','HomePermanentAddress','MailingAddress','SpouseRecords','FamilyProfile','ChildrenRecords','EducationalAttainment','ExaminationsTaken','LicenseDetails','LanguagesDialects',
            'CesWe','AssessmentCenter','ValidationHr','BoardInterview','CesStatus','RecordOfCespesRatings','WorkExperience','FieldExpertise','CesTrainings','OtherManagementTrainings',
            'ResearchAndStudies','Scholarships','Affiliations','AwardAndCitations','CaseRecords','HealthRecords','HistoricalRecordOfMedicalCondition','PdfLinks','UserRoleName',
            'PersonalDataAdd','PersonalDataEdit','PersonalDataDelete','PersonalDataViewOnly','FamilyProfileAdd','FamilyProfileEdit','FamilyProfileDelete','FamilyProfileViewOnly','EducationalAttainmentAdd',
            'EducationalAttainmentEdit','EducationalAttainmentDelete','EducationalAttainmentViewOnly','ExaminationsTakenAdd','ExaminationsTakenEdit','ExaminationsTakenDelete','ExaminationsTakenViewOnly','LanguagesDialectsAdd',
            'LanguagesDialectsEdit','LanguagesDialectsDelete','LanguagesDialectsViewOnly','EligibilityAndRankTrackerAdd','EligibilityAndRankTrackerEdit','EligibilityAndRankTrackerDelete','EligibilityAndRankTrackerViewOnly',
            'RecordOfCespesRatingsAdd','RecordOfCespesRatingsEdit','RecordOfCespesRatingsDelete','RecordOfCespesRatingsViewOnly','WorkExperienceAdd','WorkExperienceEdit','WorkExperienceDelete','WorkExperienceViewOnly','FieldExpertiseAdd',
            'FieldExpertiseEdit','FieldExpertiseDelete','FieldExpertiseViewOnly','CesTrainingsAdd','CesTrainingsEdit','CesTrainingsDelete','CesTrainingsViewOnly','OtherManagementTrainingsAdd','OtherManagementTrainingsEdit','OtherManagementTrainingsDelete',
            'OtherManagementTrainingsViewOnly','ResearchAndStudiesAdd','ResearchAndStudiesEdit','ResearchAndStudiesDelete','ResearchAndStudiesViewOnly','ScholarshipsAdd','ScholarshipsEdit','ScholarshipsDelete','ScholarshipsViewOnly','AffiliationsAdd',
            'AffiliationsEdit','AffiliationsDelete','AffiliationsViewOnly','AwardAndCitationsAdd','AwardAndCitationsEdit','AwardAndCitationsDelete','AwardAndCitationsViewOnly','CaseRecordsAdd','CaseRecordsEdit','CaseRecordsDelete','CaseRecordsViewOnly',
            'HealthRecordsAdd','HealthRecordsEdit','HealthRecordsDelete','HealthRecordsViewOnly','PdfLinksAdd','PdfLinksEdit','PdfLinksDelete','PdfLinksViewOnly',);
        }
        else{

            return 'Restricted';
        }
    }

    public function postSearch(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true'){

            if(ProfileController::latestCesNo() == 1){

                return Redirect::to('/admin/profile/add');
            }
            else{

                $search = $request->input('search');
                $numberOfResult = $request->input('numberOfResult') ?? 50;
            
                if(is_numeric($search)){

                    $searched = PersonalData::where('cesno', '=', $search)->offset(0)->limit($numberOfResult)->get();
                }
                else{

                    $searched = PersonalData::where('lastname', 'LIKE', "%$search%")->orWhere('firstname', 'LIKE', "%$search%")->orWhere('middlename', 'LIKE', "%$search%")->offset(0)->limit($numberOfResult)->get();
                }
                
                $personalData = PersonalData::where('cesno','=','1')->offset(0)->limit(1)->get();
                $SpouseRecords = SpouseRecords::where('cesno','=','1')->get();
                $FamilyProfile = FamilyProfile::where('cesno','=','1')->get();
                $ChildrenRecords = ChildrenRecords::where('cesno','=','1')->get();
                $EducationalAttainment = EducationalAttainment::where('cesno','=','1')->get();
                $ExaminationsTaken = ExaminationsTaken::where('cesno','=','1')->get();
                $LicenseDetails = LicenseDetails::where('cesno','=','1')->get();
                $LanguagesDialects = LanguagesDialects::where('cesno','=','1')->get();
                $CesWe = CesWe::where('cesno','=','1')->get();
                $AssessmentCenter = AssessmentCenter::where('cesno','=','1')->get();
                $ValidationHr = ValidationHr::where('cesno','=','1')->get();
                $BoardInterview = BoardInterview::where('cesno','=','1')->get();
                $CesStatus = CesStatus::where('cesno','=','1')->get();
                $RecordOfCespesRatings = RecordOfCespesRatings::where('cesno','=','1')->get();
                $WorkExperience = WorkExperience::where('cesno','=','1')->get();
                $FieldExpertise = FieldExpertise::where('cesno','=','1')->get();
                $CesTrainings = CesTrainings::where('cesno','=','1')->get();
                $OtherManagementTrainings = OtherManagementTrainings::where('cesno','=','1')->get();
                $ResearchAndStudies = ResearchAndStudies::where('cesno','=','1')->get();
                $Scholarships = Scholarships::where('cesno','=','1')->get();
                $Affiliations = Affiliations::where('cesno','=','1')->get();
                $AwardAndCitations = AwardAndCitations::where('cesno','=','1')->get();
                $CaseRecords = CaseRecords::where('cesno','=','1')->get();
                $HealthRecords = HealthRecords::where('cesno','=','1')->get();
                $HistoricalRecordOfMedicalCondition = HistoricalRecordOfMedicalCondition::where('cesno','=','1')->get();
                $PdfLinks = PdfLinks::where('cesno','=','1')->get();

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

                return view('admin.add_view_edit_201_profile', compact('search', 'searched', 'personalData', 'SpouseRecords', 'FamilyProfile', 'ChildrenRecords', 'EducationalAttainment','ExaminationsTaken','LicenseDetails','LanguagesDialects',
                'CesWe','AssessmentCenter','ValidationHr','BoardInterview','CesStatus','RecordOfCespesRatings','WorkExperience','FieldExpertise','CesTrainings','OtherManagementTrainings',
                'ResearchAndStudies','Scholarships','Affiliations','AwardAndCitations','CaseRecords','HealthRecords','HistoricalRecordOfMedicalCondition','PdfLinks','CityMunicipality','Degree','CourseMajor','School','ExaminationReference','LanguageDialects','CesStatusReference',
                'AcquiredThru','StatusType','AppointingAuthority','ExpertiseCategory','SpecialSkill','CaseNature','CaseStatus','LocationCity','LocationProvince','LocationRegion'))->render();
            }
        }
        else{

            return view('restricted');
        }
    }

    // Disabled function
    // public function addHomePermanentAddress(Request $request){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Add') == 'true'){
            
    //         HomePermanentAddress::create([
    //             'fb_pa' => $request->fb_pa,
    //             'ns_pa' =>  $request->ns_pa,
    //             'bd_pa' => $request->bd_pa,
    //             'cm_pa' => $request->cm_pa,
    //             'zc_pa' => $request->zc_pa,
    //             'cesno' => $request->cesno,
    //             'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
    //         ]);

    //         return 'Successfully added';
    //     }
    //     else{

    //         return 'Restricted';
    //     }
    // }

    // public function getHomePermanentAddress(Request $request){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Category Only') == 'true'){

    //         $homepermanentaddress = HomePermanentAddress::all();

    //         return $homepermanentaddress;
    //     }
    //     else{

    //         return 'Restricted';
    //     }
    // }

    // public function addMailingAddress(Request $request){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Add') == 'true'){

    //         MailingAddress::create([
    //             'fb_ma' => $request->fb_ma,
    //             'ns_ma' =>  $request->ns_ma,
    //             'bd_ma' => $request->bd_ma,
    //             'cm_ma' => $request->cm_ma,
    //             'zc_ma' => $request->zc_ma,
    //             'oea_ma' => $request->oea_ma,
    //             'mobileno1_ma' => $request->mobileno1_ma,
    //             'telno1_ma' => $request->telno1_ma,
    //             'mobileno2_ma' => $request->mobileno2_ma,
    //             'cesno' => $request->cesno,
    //             'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
    //         ]);

    //         return 'Successfully added';
    //     }
    //     else{

    //         return 'Restricted';
    //     }
    // }

    // public function getMailingAddress(Request $request){

    //     if(RolesController::validateUserExecutive201RoleAccess('Personal Data','Category Only') == 'true'){

    //         $mailingaddress = MailingAddress::all();

    //         return $mailingaddress;
    //     }
    //     else{

    //         return 'Restricted';
    //     }
    // }

    public function addSpouseRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'lastname_sn_fp' => Str::ucfirst($request->lastname_sn_fp),
                    'first_sn_fp' =>  Str::ucfirst($request->first_sn_fp),
                    'middlename_sn_fp' => Str::ucfirst($request->middlename_sn_fp),
                    'ne_sn_fp' => $request->ne_sn_fp,
                    'occu_sn_fp' => Str::ucfirst($request->occu_sn_fp),
                    'ebn_sn_fp' => Str::ucfirst($request->ebn_sn_fp),
                    'eba_sn_fp' => Str::ucfirst($request->eba_sn_fp),
                    'etn_sn_fp' => $request->etn_sn_fp,
                    'civil_status_sn_fp' => $request->civil_status_sn_fp,
                    'gender_sn_fp' => $request->gender_sn_fp,
                    'birthdate_sn_fp' => $request->birthdate_sn_fp,
                    // 'age_sn_fp' => $request->age_sn_fp,
                ),
                array(
                    'cesno' => 'required',
                    'lastname_sn_fp' => 'required|max:255',
                    'first_sn_fp' =>  'required|max:255',
                    'middlename_sn_fp' => 'required|max:255',
                    'ne_sn_fp' => '',
                    'occu_sn_fp' => '',
                    'ebn_sn_fp' => '',
                    'eba_sn_fp' => '',
                    'etn_sn_fp' => '',
                    'civil_status_sn_fp' => 'required|max:255',
                    'gender_sn_fp' => 'required|max:255',
                    'birthdate_sn_fp' => 'required|date',
                    // 'age_sn_fp' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                SpouseRecords::create([
                    'cesno' => $request->cesno,
                    'lastname_sn_fp' => Str::ucfirst($request->lastname_sn_fp),
                    'first_sn_fp' =>  Str::ucfirst($request->first_sn_fp),
                    'middlename_sn_fp' => Str::ucfirst($request->middlename_sn_fp),
                    'ne_sn_fp' => $request->ne_sn_fp,
                    'occu_sn_fp' => Str::ucfirst($request->occu_sn_fp),
                    'ebn_sn_fp' => Str::ucfirst($request->ebn_sn_fp),
                    'eba_sn_fp' => Str::ucfirst($request->eba_sn_fp),
                    'etn_sn_fp' => $request->etn_sn_fp,
                    'civil_status_sn_fp' => $request->civil_status_sn_fp,
                    'gender_sn_fp' => $request->gender_sn_fp,
                    'birthdate_sn_fp' => $request->birthdate_sn_fp,
                    // 'age_sn_fp' => $request->age_sn_fp,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editSpouseRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'lastname_sn_fp' => Str::ucfirst($request->lastname_sn_fp),
                    'first_sn_fp' =>  Str::ucfirst($request->first_sn_fp),
                    'middlename_sn_fp' => Str::ucfirst($request->middlename_sn_fp),
                    'ne_sn_fp' => $request->ne_sn_fp,
                    'occu_sn_fp' => Str::ucfirst($request->occu_sn_fp),
                    'ebn_sn_fp' => Str::ucfirst($request->ebn_sn_fp),
                    'eba_sn_fp' => Str::ucfirst($request->eba_sn_fp),
                    'etn_sn_fp' => $request->etn_sn_fp,
                    'civil_status_sn_fp' => $request->civil_status_sn_fp,
                    'gender_sn_fp' => $request->gender_sn_fp,
                    'birthdate_sn_fp' => $request->birthdate_sn_fp,
                    // 'age_sn_fp' => $request->age_sn_fp,
                ),
                array(
                    'lastname_sn_fp' => 'required',
                    'first_sn_fp' =>  'required',
                    'middlename_sn_fp' => 'required',
                    'ne_sn_fp' => '',
                    'occu_sn_fp' => '',
                    'ebn_sn_fp' => '',
                    'eba_sn_fp' => '',
                    'etn_sn_fp' => '',
                    'civil_status_sn_fp' => 'required',
                    'gender_sn_fp' => 'required',
                    'birthdate_sn_fp' => 'required|date',
                    // 'age_sn_fp' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                SpouseRecords::where('id', $request->cesno_spouse_records_id)
                ->update([
                    'lastname_sn_fp' => Str::ucfirst($request->lastname_sn_fp),
                    'first_sn_fp' =>  Str::ucfirst($request->first_sn_fp),
                    'middlename_sn_fp' => Str::ucfirst($request->middlename_sn_fp),
                    'ne_sn_fp' => $request->ne_sn_fp,
                    'occu_sn_fp' => Str::ucfirst($request->occu_sn_fp),
                    'ebn_sn_fp' => Str::ucfirst($request->ebn_sn_fp),
                    'eba_sn_fp' => Str::ucfirst($request->eba_sn_fp),
                    'etn_sn_fp' => $request->etn_sn_fp,
                    'civil_status_sn_fp' => $request->civil_status_sn_fp,
                    'gender_sn_fp' => $request->gender_sn_fp,
                    'birthdate_sn_fp' => $request->birthdate_sn_fp,
                    // 'age_sn_fp' => $request->age_sn_fp,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getSpouseRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Category Only') == 'true'){

            $spouserecords = SpouseRecords::where('id','=',$id)->get();

            return $spouserecords;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteSpouseRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Delete') == 'true'){

            $spouserecords = SpouseRecords::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
        
    }

    public function addFamilyProfile(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'fn_lastname_fp' => Str::ucfirst($request->fn_lastname_fp),
                    'fn_first_fp' =>  Str::ucfirst($request->fn_first_fp),
                    'fn_middlename_fp' => Str::ucfirst($request->fn_middlename_fp),
                    'fn_ne_fp' => $request->fn_ne_fp,
                    'mn_lastname_fp' => Str::ucfirst($request->mn_lastname_fp),
                    'mn_first_fp' =>  Str::ucfirst($request->mn_first_fp),
                    'mn_middlename_fp' => Str::ucfirst($request->mn_middlename_fp),
                ),
                array(
                    'cesno' => 'required',
                    'fn_lastname_fp' => 'required',
                    'fn_first_fp' =>  'required',
                    'fn_middlename_fp' => 'required',
                    'fn_ne_fp' => '',
                    'mn_lastname_fp' => 'required',
                    'mn_first_fp' => 'required',
                    'mn_middlename_fp' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                FamilyProfile::create([
                    'cesno' => $request->cesno,
                    'fn_lastname_fp' => Str::ucfirst($request->fn_lastname_fp),
                    'fn_first_fp' =>  Str::ucfirst($request->fn_first_fp),
                    'fn_middlename_fp' => Str::ucfirst($request->fn_middlename_fp),
                    'fn_ne_fp' => $request->fn_ne_fp,
                    'mn_lastname_fp' => Str::ucfirst($request->mn_lastname_fp),
                    'mn_first_fp' =>  Str::ucfirst($request->mn_first_fp),
                    'mn_middlename_fp' => Str::ucfirst($request->mn_middlename_fp),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editFamilyProfile(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'fn_lastname_fp' => Str::ucfirst($request->fn_lastname_fp),
                    'fn_first_fp' =>  Str::ucfirst($request->fn_first_fp),
                    'fn_middlename_fp' => Str::ucfirst($request->fn_middlename_fp),
                    'fn_ne_fp' => $request->fn_ne_fp,
                    'mn_lastname_fp' => Str::ucfirst($request->mn_lastname_fp),
                    'mn_first_fp' =>  Str::ucfirst($request->mn_first_fp),
                    'mn_middlename_fp' => Str::ucfirst($request->mn_middlename_fp),
                ),
                array(
                    'fn_lastname_fp' => 'required',
                    'fn_first_fp' =>  'required',
                    'fn_middlename_fp' => 'required',
                    'fn_ne_fp' => '',
                    'mn_lastname_fp' => 'required',
                    'mn_first_fp' => 'required',
                    'mn_middlename_fp' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                FamilyProfile::where('id', $request->cesno_family_profile_id)
                ->update([
                    'fn_lastname_fp' => Str::ucfirst($request->fn_lastname_fp),
                    'fn_first_fp' =>  Str::ucfirst($request->fn_first_fp),
                    'fn_middlename_fp' => Str::ucfirst($request->fn_middlename_fp),
                    'fn_ne_fp' => $request->fn_ne_fp,
                    'mn_lastname_fp' => Str::ucfirst($request->mn_lastname_fp),
                    'mn_first_fp' =>  Str::ucfirst($request->mn_first_fp),
                    'mn_middlename_fp' => Str::ucfirst($request->mn_middlename_fp),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getFamilyProfile($id){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Category Only') == 'true'){

            $familyprofile = FamilyProfile::where('id','=',$id)->get();

            return $familyprofile;
        }
        else{

            return 'Restricted';
        }
    }

    // public function deleteFamilyProfile($id){

    //     if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Delete') == 'true'){

    //         $familyprofile = FamilyProfile::where('id','=',$id)->delete();

    //         return 'Successfully deleted';
    //     }
    //     else{

    //         return 'Restricted';
    //     }
    // }

    public function addChildrenRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'ch_lastname_fp' => Str::ucfirst($request->ch_lastname_fp),
                    'ch_first_fp' =>  Str::ucfirst($request->ch_first_fp),
                    'ch_middlename_fp' => Str::ucfirst($request->ch_middlename_fp),
                    'ch_ne_fp' => $request->ch_ne_fp,
                    'ch_gender_fp' => $request->ch_gender_fp,
                    'ch_birthdate_fp' => $request->ch_birthdate_fp,
                    'ch_birthplace_fp' => Str::ucfirst($request->ch_birthplace_fp),
                ),
                array(
                    'cesno' => 'required',
                    'ch_lastname_fp' => 'required|max:255',
                    'ch_first_fp' =>  'required|max:255',
                    'ch_middlename_fp' => 'required|max:255',
                    'ch_ne_fp' => '',
                    'ch_gender_fp' => 'required|max:255',
                    'ch_birthdate_fp' => 'required|date',
                    'ch_birthplace_fp' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ChildrenRecords::create([
                    'cesno' => $request->cesno,
                    'ch_lastname_fp' => Str::ucfirst($request->ch_lastname_fp),
                    'ch_first_fp' =>  Str::ucfirst($request->ch_first_fp),
                    'ch_middlename_fp' => Str::ucfirst($request->ch_middlename_fp),
                    'ch_ne_fp' => $request->ch_ne_fp,
                    'ch_gender_fp' => $request->ch_gender_fp,
                    'ch_birthdate_fp' => $request->ch_birthdate_fp,
                    'ch_birthplace_fp' => Str::ucfirst($request->ch_birthplace_fp),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editChildrenRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'ch_lastname_fp' => Str::ucfirst($request->ch_lastname_fp),
                    'ch_first_fp' =>  Str::ucfirst($request->ch_first_fp),
                    'ch_middlename_fp' => Str::ucfirst($request->ch_middlename_fp),
                    'ch_ne_fp' => $request->ch_ne_fp,
                    'ch_gender_fp' => $request->ch_gender_fp,
                    'ch_birthdate_fp' => $request->ch_birthdate_fp,
                    'ch_birthplace_fp' => Str::ucfirst($request->ch_birthplace_fp),
                ),
                array(
                    'ch_lastname_fp' => 'required|max:255',
                    'ch_first_fp' =>  'required|max:255',
                    'ch_middlename_fp' => 'required|max:255',
                    'ch_ne_fp' => '',
                    'ch_gender_fp' => 'required|max:255',
                    'ch_birthdate_fp' => 'required|date',
                    'ch_birthplace_fp' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ChildrenRecords::where('id', $request->cesno_children_record_id)
                ->update([
                    'ch_lastname_fp' => Str::ucfirst($request->ch_lastname_fp),
                    'ch_first_fp' =>  Str::ucfirst($request->ch_first_fp),
                    'ch_middlename_fp' => Str::ucfirst($request->ch_middlename_fp),
                    'ch_ne_fp' => $request->ch_ne_fp,
                    'ch_gender_fp' => $request->ch_gender_fp,
                    'ch_birthdate_fp' => $request->ch_birthdate_fp,
                    'ch_birthplace_fp' => Str::ucfirst($request->ch_birthplace_fp),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getChildrenRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Category Only') == 'true'){

            $childrenrecords = ChildrenRecords::where('id','=',$id)->get();

            return $childrenrecords;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteChildrenRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Family Background Profile','Delete') == 'true'){

            $childrenrecords = ChildrenRecords::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addEducationalAttainment(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'level_ea' => $request->level_ea,
                    'school_ea' =>  $request->school_ea,
                    'degree_ea' => $request->degree_ea,
                    'date_grad_ea' => $request->date_grad_ea,
                    'ms_ea' => $request->ms_ea,
                    'school_type_ea' => $request->school_type_ea,
                    'date_f_ea' => $request->date_f_ea,
                    'date_t_ea' => $request->date_t_ea,
                    'hlu_ea' => $request->hlu_ea,
                    'ahr_ea' => $request->ahr_ea,
                ),
                array(
                    'cesno' => 'required',
                    'level_ea' => 'required|max:255',
                    'school_ea' => 'required|max:255',
                    'degree_ea' => 'required|max:255',
                    'date_grad_ea' => 'required|max:255',
                    'ms_ea' => 'required|max:255',
                    'school_type_ea' => 'required|max:255',
                    'date_f_ea' => 'required|date',
                    'date_t_ea' => 'required|date',
                    'hlu_ea' => 'required|max:255',
                    'ahr_ea' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                EducationalAttainment::create([
                    'cesno' => $request->cesno,
                    'level_ea' => $request->level_ea,
                    'school_ea' =>  $request->school_ea,
                    'degree_ea' => $request->degree_ea,
                    'date_grad_ea' => $request->date_grad_ea,
                    'ms_ea' => $request->ms_ea,
                    'school_type_ea' => $request->school_type_ea,
                    'date_f_ea' => $request->date_f_ea,
                    'date_t_ea' => $request->date_t_ea,
                    'hlu_ea' => $request->hlu_ea,
                    'ahr_ea' => $request->ahr_ea,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editEducationalAttainment(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'level_ea' => $request->level_ea,
                    'school_ea' =>  $request->school_ea,
                    'degree_ea' => $request->degree_ea,
                    'date_grad_ea' => $request->date_grad_ea,
                    'ms_ea' => $request->ms_ea,
                    'school_type_ea' => $request->school_type_ea,
                    'date_f_ea' => $request->date_f_ea,
                    'date_t_ea' => $request->date_t_ea,
                    'hlu_ea' => $request->hlu_ea,
                    'ahr_ea' => $request->ahr_ea,
                ),
                array(
                    'level_ea' => 'required|max:255',
                    'school_ea' => 'required|max:255',
                    'degree_ea' => 'required|max:255',
                    'date_grad_ea' => 'required|max:255',
                    'ms_ea' => 'required|max:255',
                    'school_type_ea' => 'required|max:255',
                    'date_f_ea' => 'required|date',
                    'date_t_ea' => 'required|date',
                    'hlu_ea' => 'required|max:255',
                    'ahr_ea' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                EducationalAttainment::where('id', $request->cesno_educational_attainment_id)
                ->update([
                    'level_ea' => $request->level_ea,
                    'school_ea' =>  $request->school_ea,
                    'degree_ea' => $request->degree_ea,
                    'date_grad_ea' => $request->date_grad_ea,
                    'ms_ea' => $request->ms_ea,
                    'school_type_ea' => $request->school_type_ea,
                    'date_f_ea' => $request->date_f_ea,
                    'date_t_ea' => $request->date_t_ea,
                    'hlu_ea' => $request->hlu_ea,
                    'ahr_ea' => $request->ahr_ea,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getEducationalAttainment($id){

        if(RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment','Category Only') == 'true'){

            $educationalattainment = EducationalAttainment::where('id','=',$id)->get();

            return $educationalattainment;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteEducationalAttainment($id){

        if(RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment','Delete') == 'true'){

            $educationalattainment = EducationalAttainment::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addExaminationTaken(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'tox_et' => $request->tox_et,
                    'rating_et' =>  $request->rating_et,
                    'doe_et' => $request->doe_et,
                    'poe_et' => $request->poe_et,
                ),
                array(
                    'cesno' => 'required',
                    'tox_et' => 'required|max:255',
                    'rating_et' =>  'required|max:255',
                    'doe_et' => 'required|date',
                    'poe_et' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{
                
                ExaminationsTaken::create([
                    'cesno' => $request->cesno,
                    'tox_et' => $request->tox_et,
                    'rating_et' =>  $request->rating_et,
                    'doe_et' => $request->doe_et,
                    'poe_et' => $request->poe_et,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);
                
                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editExaminationTaken(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'tox_et' => $request->tox_et,
                    'rating_et' =>  $request->rating_et,
                    'doe_et' => $request->doe_et,
                    'poe_et' => $request->poe_et,
                ),
                array(
                    'tox_et' => 'required|max:255',
                    'rating_et' =>  'required|max:255',
                    'doe_et' => 'required|date',
                    'poe_et' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ExaminationsTaken::where('id', $request->cesno_examinations_taken_historical_records_id)
                ->update([
                    'tox_et' => $request->tox_et,
                    'rating_et' =>  $request->rating_et,
                    'doe_et' => $request->doe_et,
                    'poe_et' => $request->poe_et,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);
                
                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getExaminationTaken($id){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Category Only') == 'true'){

            $examinationstaken = ExaminationsTaken::where('id','=',$id)->get();

            return $examinationstaken;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteExaminationTaken($id){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Delete') == 'true'){

            $examinationstaken = ExaminationsTaken::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addLicenseDetails(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'ld_ln_et' => $request->ld_ln_et,
                    'ld_da_et' =>  $request->ld_da_et,
                    'ld_dov_et' => $request->ld_dov_et,
                ),
                array(
                    'cesno' => 'required',
                    'ld_ln_et' => 'required|max:255',
                    'ld_da_et' => 'required|date',
                    'ld_dov_et' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                LicenseDetails::create([
                    'cesno' => $request->cesno,
                    'ld_ln_et' => $request->ld_ln_et,
                    'ld_da_et' =>  $request->ld_da_et,
                    'ld_dov_et' => $request->ld_dov_et,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editLicenseDetails(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'ld_ln_et' => $request->ld_ln_et,
                    'ld_da_et' =>  $request->ld_da_et,
                    'ld_dov_et' => $request->ld_dov_et,
                ),
                array(
                    'ld_ln_et' => 'required|max:255',
                    'ld_da_et' => 'required|date',
                    'ld_dov_et' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{
                
                LicenseDetails::where('id', $request->cesno_examinations_taken_license_details_id)
                ->update([
                    'ld_ln_et' => $request->ld_ln_et,
                    'ld_da_et' =>  $request->ld_da_et,
                    'ld_dov_et' => $request->ld_dov_et,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getLicenseDetails($id){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Category Only') == 'true'){

            $licensedetails = LicenseDetails::where('id','=',$id)->get();

            return $licensedetails;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteLicenseDetails($id){

        if(RolesController::validateUserExecutive201RoleAccess('Examinations Taken','Delete') == 'true'){

            $licensedetails = LicenseDetails::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }
    
    public function addLanguagesDialects(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Language Dialects','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'lang_languages_dialects' => $request->lang_languages_dialects,
                ),
                array(
                    'cesno' => 'required',
                    'lang_languages_dialects' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                LanguagesDialects::create([
                    'cesno' => $request->cesno,
                    'lang_languages_dialects' => $request->lang_languages_dialects,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editLanguagesDialects(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Language Dialects','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'lang_languages_dialects' => $request->lang_languages_dialects,
                ),
                array(
                    'lang_languages_dialects' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                LanguagesDialects::where('id', $request->cesno_languages_dialects_id)
                ->update([
                    'lang_languages_dialects' => $request->lang_languages_dialects,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getLanguagesDialects($id){

        if(RolesController::validateUserExecutive201RoleAccess('Language Dialects','Category Only') == 'true'){

            $languagesdialects = LanguagesDialects::where('id','=',$id)->get();

            return $languagesdialects;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteLanguagesDialects($id){

        if(RolesController::validateUserExecutive201RoleAccess('Language Dialects','Delete') == 'true'){

            $languagesdialects = LanguagesDialects::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addCesWe(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Add') == 'true'){
        
            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'ed_ces_we' => $request->ed_ces_we,
                    'r_ces_we' =>  $request->r_ces_we,
                    'rd_ces_we' => $request->rd_ces_we,
                    'poe_ces_we' => $request->poe_ces_we,
                    'tn_ces_we' => $request->tn_ces_we,
                ),
                array(
                    'cesno' => 'required',
                    'ed_ces_we' => 'required|date',
                    'r_ces_we' =>  'required|max:255',
                    'rd_ces_we' => 'required|max:255',
                    'poe_ces_we' => 'required|max:255',
                    'tn_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesWe::create([
                    'cesno' => $request->cesno,
                    'ed_ces_we' => $request->ed_ces_we,
                    'r_ces_we' =>  $request->r_ces_we,
                    'rd_ces_we' => $request->rd_ces_we,
                    'poe_ces_we' => $request->poe_ces_we,
                    'tn_ces_we' => $request->tn_ces_we,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editCesWe(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'ed_ces_we' => $request->ed_ces_we,
                    'r_ces_we' =>  $request->r_ces_we,
                    'rd_ces_we' => $request->rd_ces_we,
                    'poe_ces_we' => $request->poe_ces_we,
                    'tn_ces_we' => $request->tn_ces_we,
                ),
                array(
                    'ed_ces_we' => 'required|date',
                    'r_ces_we' =>  'required|max:255',
                    'rd_ces_we' => 'required|max:255',
                    'poe_ces_we' => 'required|max:255',
                    'tn_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesWe::where('id', $request->cesno_ceswe_hr_id)
                ->update([
                    'ed_ces_we' => $request->ed_ces_we,
                    'r_ces_we' =>  $request->r_ces_we,
                    'rd_ces_we' => $request->rd_ces_we,
                    'poe_ces_we' => $request->poe_ces_we,
                    'tn_ces_we' => $request->tn_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getCesWe($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Category Only') == 'true'){

            $ceswe = CesWe::where('id','=',$id)->get();

            return $ceswe;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteCesWe($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Delete') == 'true'){

            $ceswe = CesWe::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addAssessmentCenter(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'an_achr_ces_we' => $request->an_achr_ces_we,
                    'ad_achr_ces_we' =>  $request->ad_achr_ces_we,
                    'r_achr_ces_we' => $request->r_achr_ces_we,
                    'cfd_achr_ces_we' => $request->cfd_achr_ces_we,
                ),
                array(
                    'cesno' => 'required',
                    'an_achr_ces_we' => 'required|max:255',
                    'ad_achr_ces_we' =>  'required|date',
                    'r_achr_ces_we' => 'required|max:255',
                    'cfd_achr_ces_we' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                AssessmentCenter::create([
                    'cesno' => $request->cesno,
                    'an_achr_ces_we' => $request->an_achr_ces_we,
                    'ad_achr_ces_we' =>  $request->ad_achr_ces_we,
                    'r_achr_ces_we' => $request->r_achr_ces_we,
                    'cfd_achr_ces_we' => $request->cfd_achr_ces_we,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editAssessmentCenter(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'an_achr_ces_we' => $request->an_achr_ces_we,
                    'ad_achr_ces_we' =>  $request->ad_achr_ces_we,
                    'r_achr_ces_we' => $request->r_achr_ces_we,
                    'cfd_achr_ces_we' => $request->cfd_achr_ces_we,
                ),
                array(
                    'an_achr_ces_we' => 'required|max:255',
                    'ad_achr_ces_we' =>  'required|date',
                    'r_achr_ces_we' => 'required|max:255',
                    'cfd_achr_ces_we' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                AssessmentCenter::where('id', $request->cesno_assessment_center_hr_id)
                ->update([
                    'an_achr_ces_we' => $request->an_achr_ces_we,
                    'ad_achr_ces_we' =>  $request->ad_achr_ces_we,
                    'r_achr_ces_we' => $request->r_achr_ces_we,
                    'cfd_achr_ces_we' => $request->cfd_achr_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getAssessmentCenter($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Category Only') == 'true'){

            $assessmentcenter = AssessmentCenter::where('id','=',$id)->get();

            return $assessmentcenter;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteAssessmentCenter($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Delete') == 'true'){

            $assessmentcenter = AssessmentCenter::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addValidationHr(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'vd_vhr_ces_we' => $request->vd_vhr_ces_we,
                    'tov_vhr_ces_we' =>  $request->tov_vhr_ces_we,
                    'r_vhr_ces_we' => $request->r_vhr_ces_we,
                ),
                array(
                    'cesno' => 'required',
                    'vd_vhr_ces_we' => 'required|date',
                    'tov_vhr_ces_we' => 'required|max:255',
                    'r_vhr_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ValidationHr::create([
                    'cesno' => $request->cesno,
                    'vd_vhr_ces_we' => $request->vd_vhr_ces_we,
                    'tov_vhr_ces_we' =>  $request->tov_vhr_ces_we,
                    'r_vhr_ces_we' => $request->r_vhr_ces_we,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editValidationHr(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'vd_vhr_ces_we' => $request->vd_vhr_ces_we,
                    'tov_vhr_ces_we' =>  $request->tov_vhr_ces_we,
                    'r_vhr_ces_we' => $request->r_vhr_ces_we,
                ),
                array(
                    'vd_vhr_ces_we' => 'required|date',
                    'tov_vhr_ces_we' => 'required|max:255',
                    'r_vhr_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ValidationHr::where('id', $request->cesno_validation_hr_id)
                ->update([
                    'vd_vhr_ces_we' => $request->vd_vhr_ces_we,
                    'tov_vhr_ces_we' =>  $request->tov_vhr_ces_we,
                    'r_vhr_ces_we' => $request->r_vhr_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getValidationHr($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Category Only') == 'true'){

            $validationhr = ValidationHr::where('id','=',$id)->get();

            return $validationhr;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteValidationHr($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Delete') == 'true'){

            $validationhr = ValidationHr::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addBoardInterview(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'bid_bi_ces_we' => $request->bid_bi_ces_we,
                    'r_bi_ces_we' =>  $request->r_bi_ces_we,
                ),
                array(
                    'cesno' => 'required',
                    'bid_bi_ces_we' => 'required|date',
                    'r_bi_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                BoardInterview::create([
                    'cesno' => $request->cesno,
                    'bid_bi_ces_we' => $request->bid_bi_ces_we,
                    'r_bi_ces_we' =>  $request->r_bi_ces_we,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editBoardInterview(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'bid_bi_ces_we' => $request->bid_bi_ces_we,
                    'r_bi_ces_we' =>  $request->r_bi_ces_we,
                ),
                array(
                    'bid_bi_ces_we' => 'required|date',
                    'r_bi_ces_we' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                BoardInterview::where('id', $request->cesno_board_interview_hr_id)
                ->update([
                    'bid_bi_ces_we' => $request->bid_bi_ces_we,
                    'r_bi_ces_we' =>  $request->r_bi_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getBoardInterview($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Category Only') == 'true'){

            $boardinterviewhr = BoardInterview::where('id','=',$id)->get();

            return $boardinterviewhr;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteBoardInterview($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Delete') == 'true'){

            $boardinterviewhr = BoardInterview::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addCesStatus(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'cs_cs_ces_we' => $request->cs_cs_ces_we,
                    'at_cs_ces_we' =>  $request->at_cs_ces_we,
                    'st_cs_ces_we' => $request->st_cs_ces_we,
                    'aa_cs_ces_we' => $request->aa_cs_ces_we,
                    'rn_cs_ces_we' => $request->rn_cs_ces_we,
                    'da_cs_ces_we' => $request->da_cs_ces_we,
                ),
                array(
                    'cesno' => 'required',
                    'cs_cs_ces_we' => 'required|max:255',
                    'at_cs_ces_we' => 'required|max:255',
                    'st_cs_ces_we' => 'required|max:255',
                    'aa_cs_ces_we' => 'required|max:255',
                    'rn_cs_ces_we' => 'required|max:255',
                    'da_cs_ces_we' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesStatus::create([
                    'cesno' => $request->cesno,
                    'cs_cs_ces_we' => $request->cs_cs_ces_we,
                    'at_cs_ces_we' =>  $request->at_cs_ces_we,
                    'st_cs_ces_we' => $request->st_cs_ces_we,
                    'aa_cs_ces_we' => $request->aa_cs_ces_we,
                    'rn_cs_ces_we' => $request->rn_cs_ces_we,
                    'da_cs_ces_we' => $request->da_cs_ces_we,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                PersonalData::where('cesno','=',$request->cesno)->update([
                    'cesstat_code' => $request->cs_cs_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editCesStatus(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cs_cs_ces_we' => $request->cs_cs_ces_we,
                    'at_cs_ces_we' =>  $request->at_cs_ces_we,
                    'st_cs_ces_we' => $request->st_cs_ces_we,
                    'aa_cs_ces_we' => $request->aa_cs_ces_we,
                    'rn_cs_ces_we' => $request->rn_cs_ces_we,
                    'da_cs_ces_we' => $request->da_cs_ces_we,
                ),
                array(
                    'cs_cs_ces_we' => 'required|max:255',
                    'at_cs_ces_we' => 'required|max:255',
                    'st_cs_ces_we' => 'required|max:255',
                    'aa_cs_ces_we' => 'required|max:255',
                    'rn_cs_ces_we' => 'required|max:255',
                    'da_cs_ces_we' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesStatus::where('id', $request->cesno_ces_status_hr_id)
                ->update([
                    'cs_cs_ces_we' => $request->cs_cs_ces_we,
                    'at_cs_ces_we' =>  $request->at_cs_ces_we,
                    'st_cs_ces_we' => $request->st_cs_ces_we,
                    'aa_cs_ces_we' => $request->aa_cs_ces_we,
                    'rn_cs_ces_we' => $request->rn_cs_ces_we,
                    'da_cs_ces_we' => $request->da_cs_ces_we,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                // Get cesno CES Status
                $cesno_cestatus = CesStatus::where('cesno','=',$request->cesno)->get();

                // Get cesno last or latest CES Status
                foreach($cesno_cestatus as $item){

                    if($cesno_cestatus->last() == $item){

                        if($request->cesno_ces_status_hr_id == $item->id){

                            // Update cesno last or latest CES Status in personal_data table
                            PersonalData::where('cesno','=',$request->cesno)->update([
                                'cesstat_code' => $request->cs_cs_ces_we,
                                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                            ]);

                        }

                    }
                }

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getCesStatus($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Category Only') == 'true'){

            $cesstatus = CesStatus::where('id','=',$id)->get();

            return $cesstatus;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteCesStatus($id){

        if(RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker','Delete') == 'true'){

            $cesstatus = CesStatus::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addRecordOfCespesRatings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_from_rocr' => $request->date_from_rocr,
                    'date_to_rocr' =>  $request->date_to_rocr,
                    'rating_rocr' => $request->rating_rocr,
                    'status_rocr' => $request->status_rocr,
                    'remarks_rocr' => Str::ucfirst($request->remarks_rocr),
                    'pdf_rating_certificate_rocr' => $request->pdf_rating_certificate_rocr,
                ),
                array(
                    'cesno' => 'required',
                    'date_from_rocr' => 'required|date',
                    'date_to_rocr' =>  'required|date',
                    'rating_rocr' => 'required|max:255',
                    'status_rocr' => 'required|max:255',
                    'remarks_rocr' => 'required',
                    'pdf_rating_certificate_rocr' => 'required|mimetypes:application/pdf',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{
            
                if($request->hasFile('pdf_rating_certificate_rocr')){

                    // Get file details

                    $filename_with_ext = $request->file('pdf_rating_certificate_rocr')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('pdf_rating_certificate_rocr')->getClientOriginalExtension();

                    Storage::disk('f-drive')->putFileAs('PDF Documents/201 Folder/CESPES Certificate of Rating/', $request->file('pdf_rating_certificate_rocr'), date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension);

                    $pdf_rating_certificate_rocr_file_name = date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension;

                }
                else{
                
                    $pdf_rating_certificate_rocr_file_name = '';  
                }   

                RecordOfCespesRatings::create([
                    'cesno' => $request->cesno,
                    'date_from_rocr' => $request->date_from_rocr,
                    'date_to_rocr' =>  $request->date_to_rocr,
                    'rating_rocr' => $request->rating_rocr,
                    'status_rocr' => $request->status_rocr,
                    'remarks_rocr' => Str::ucfirst($request->remarks_rocr),
                    'pdf_rating_certificate_rocr' => $pdf_rating_certificate_rocr_file_name,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editRecordOfCespesRatings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_from_rocr' => $request->date_from_rocr,
                    'date_to_rocr' =>  $request->date_to_rocr,
                    'rating_rocr' => $request->rating_rocr,
                    'status_rocr' => $request->status_rocr,
                    'remarks_rocr' => Str::ucfirst($request->remarks_rocr),
                    'pdf_rating_certificate_rocr' => $request->pdf_rating_certificate_rocr,
                ),
                array(
                    'date_from_rocr' => 'required|date',
                    'date_to_rocr' =>  'required|date',
                    'rating_rocr' => 'required|max:255',
                    'status_rocr' => 'required|max:255',
                    'remarks_rocr' => 'required',
                    'pdf_rating_certificate_rocr' => 'required|mimetypes:application/pdf',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                $RecordOfCespesRatings = RecordOfCespesRatings::where('id','=',$request->cesno_record_of_cespes_rating_hr_id)->get();
                $RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name = $RecordOfCespesRatings[0]->pdf_rating_certificate_rocr;

                if($request->hasFile('pdf_rating_certificate_rocr')){

                    // Get file details

                    $filename_with_ext = $request->file('pdf_rating_certificate_rocr')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('pdf_rating_certificate_rocr')->getClientOriginalExtension();

                    // Delete pdflink file

                    if(Storage::disk('f-drive')->exists('PDF Documents/201 Folder/CESPES Certificate of Rating/'.$RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name)){

                        Storage::disk('f-drive')->delete('PDF Documents/201 Folder/CESPES Certificate of Rating/'.$RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name);
                    }

                    Storage::disk('f-drive')->putFileAs('PDF Documents/201 Folder/CESPES Certificate of Rating/', $request->file('pdf_rating_certificate_rocr'), date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension);

                    $pdf_rating_certificate_rocr_file_name = date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension;

                }
                else{
                
                    $pdf_rating_certificate_rocr_file_name = $RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name;  
                }   

                RecordOfCespesRatings::where('id', $request->cesno_record_of_cespes_rating_hr_id)
                ->update([
                    'date_from_rocr' => $request->date_from_rocr,
                    'date_to_rocr' =>  $request->date_to_rocr,
                    'rating_rocr' => $request->rating_rocr,
                    'status_rocr' => $request->status_rocr,
                    'remarks_rocr' => Str::ucfirst($request->remarks_rocr),
                    'pdf_rating_certificate_rocr' => $pdf_rating_certificate_rocr_file_name,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getRecordOfCespesRatings($id){

        if(RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings','Category Only') == 'true'){

            $RecordOfCespesRatings = RecordOfCespesRatings::where('id','=',$id)->get();

            return $RecordOfCespesRatings;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteRecordOfCespesRatings($id){

        if(RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings','Delete') == 'true'){

            $RecordOfCespesRatings = RecordOfCespesRatings::where('id','=',$id)->get();
            $RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name = $RecordOfCespesRatings[0]->pdf_rating_certificate_rocr;

            // Delete pdflink file

            if(Storage::disk('f-drive')->exists('PDF Documents/201 Folder/CESPES Certificate of Rating/'.$RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name)){

                Storage::disk('f-drive')->delete('PDF Documents/201 Folder/CESPES Certificate of Rating/'.$RecordOfCespesRatings_pdf_rating_certificate_rocr_file_name);
            }

            $RecordOfCespesRatings = RecordOfCespesRatings::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addWorkExperience(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Work Experience','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_from_work_experience' => $request->date_from_work_experience,
                    'date_to_work_experience' =>  $request->date_to_work_experience,
                    'destination_from_work_experience' => $request->destination_from_work_experience,
                    'status_from_work_experience' => $request->status_from_work_experience,
                    'salary_from_work_experience' => $request->salary_from_work_experience,
                    'salary_job_pay_grade_work_experience' => $request->salary_job_pay_grade_work_experience,
                    'status_of_appointment_work_experience' => $request->status_of_appointment_work_experience,
                    'government_service_work_experience' => $request->government_service_work_experience,
                    'department_from_work_experience' => $request->department_from_work_experience,
                    'remarks_from_work_experience' => Str::ucfirst($request->remarks_from_work_experience),
                ),
                array(
                    'cesno' => 'required',
                    'date_from_work_experience' => 'required|date',
                    'date_to_work_experience' => 'required|date',
                    'destination_from_work_experience' => 'required|max:255',
                    'status_from_work_experience' => 'required|max:255',
                    'salary_from_work_experience' => 'required|max:255',
                    'salary_job_pay_grade_work_experience' => 'required|max:255',
                    'status_of_appointment_work_experience' => 'required|max:255',
                    'government_service_work_experience' => 'required|max:255',
                    'department_from_work_experience' => 'required|max:255',
                    'remarks_from_work_experience' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                WorkExperience::create([
                    'cesno' => $request->cesno,
                    'date_from_work_experience' => $request->date_from_work_experience,
                    'date_to_work_experience' =>  $request->date_to_work_experience,
                    'destination_from_work_experience' => $request->destination_from_work_experience,
                    'status_from_work_experience' => $request->status_from_work_experience,
                    'salary_from_work_experience' => $request->salary_from_work_experience,
                    'salary_job_pay_grade_work_experience' => $request->salary_job_pay_grade_work_experience,
                    'status_of_appointment_work_experience' => $request->status_of_appointment_work_experience,
                    'government_service_work_experience' => $request->government_service_work_experience,
                    'department_from_work_experience' => $request->department_from_work_experience,
                    'remarks_from_work_experience' => Str::ucfirst($request->remarks_from_work_experience),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editWorkExperience(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Work Experience','Edit') == 'true'){
        
            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_from_work_experience' => $request->date_from_work_experience,
                    'date_to_work_experience' =>  $request->date_to_work_experience,
                    'destination_from_work_experience' => $request->destination_from_work_experience,
                    'status_from_work_experience' => $request->status_from_work_experience,
                    'salary_from_work_experience' => $request->salary_from_work_experience,
                    'salary_job_pay_grade_work_experience' => $request->salary_job_pay_grade_work_experience,
                    'status_of_appointment_work_experience' => $request->status_of_appointment_work_experience,
                    'government_service_work_experience' => $request->government_service_work_experience,
                    'department_from_work_experience' => $request->department_from_work_experience,
                    'remarks_from_work_experience' => Str::ucfirst($request->remarks_from_work_experience),
                ),
                array(
                    'date_from_work_experience' => 'required|date',
                    'date_to_work_experience' => 'required|date',
                    'destination_from_work_experience' => 'required|max:255',
                    'status_from_work_experience' => 'required|max:255',
                    'salary_from_work_experience' => 'required|max:255',
                    'salary_job_pay_grade_work_experience' => 'required|max:255',
                    'status_of_appointment_work_experience' => 'required|max:255',
                    'government_service_work_experience' => 'required|max:255',
                    'department_from_work_experience' => 'required|max:255',
                    'remarks_from_work_experience' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                WorkExperience::where('id', $request->cesno_work_experience_id)
                ->update([
                    'date_from_work_experience' => $request->date_from_work_experience,
                    'date_to_work_experience' =>  $request->date_to_work_experience,
                    'destination_from_work_experience' => $request->destination_from_work_experience,
                    'status_from_work_experience' => $request->status_from_work_experience,
                    'salary_from_work_experience' => $request->salary_from_work_experience,
                    'salary_job_pay_grade_work_experience' => $request->salary_job_pay_grade_work_experience,
                    'status_of_appointment_work_experience' => $request->status_of_appointment_work_experience,
                    'government_service_work_experience' => $request->government_service_work_experience,
                    'department_from_work_experience' => $request->department_from_work_experience,
                    'remarks_from_work_experience' => Str::ucfirst($request->remarks_from_work_experience),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getWorkExperience($id){

        if(RolesController::validateUserExecutive201RoleAccess('Work Experience','Category Only') == 'true'){

            $WorkExperience = WorkExperience::where('id','=',$id)->get();

            return $WorkExperience;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteWorkExperience($id){

        if(RolesController::validateUserExecutive201RoleAccess('Work Experience','Delete') == 'true'){

            $WorkExperience = WorkExperience::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addFieldExpertise(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'ec_field_expertise' => $request->ec_field_expertise,
                    'ss_field_expertise' =>  $request->ss_field_expertise,
                ),
                array(
                    'cesno' => 'required',
                    'ec_field_expertise' => 'required|max:255',
                    'ss_field_expertise' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                FieldExpertise::create([
                    'cesno' => $request->cesno,
                    'ec_field_expertise' => $request->ec_field_expertise,
                    'ss_field_expertise' =>  $request->ss_field_expertise,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editFieldExpertise(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'ec_field_expertise' => $request->ec_field_expertise,
                    'ss_field_expertise' =>  $request->ss_field_expertise,
                ),
                array(
                    'ec_field_expertise' => 'required|max:255',
                    'ss_field_expertise' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                FieldExpertise::where('id', $request->cesno_field_expertise_id)
                ->update([
                    'ec_field_expertise' => $request->ec_field_expertise,
                    'ss_field_expertise' =>  $request->ss_field_expertise,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getFieldExpertise($id){

        if(RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization','Category Only') == 'true'){

            $FieldExpertise = FieldExpertise::where('id','=',$id)->get();

            return $FieldExpertise;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteFieldExpertise($id){

        if(RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization','Delete') == 'true'){

            $FieldExpertise = FieldExpertise::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addCesTrainings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('CES Trainings','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    's_title_ces_trainings' => $request->s_title_ces_trainings,
                    's_no_ces_trainings' =>  $request->s_no_ces_trainings,
                    'training_category_ces_trainings' =>  $request->training_category_ces_trainings,
                    'fos_ces_trainings' =>  $request->fos_ces_trainings,
                    'venue_ces_trainings' =>  $request->venue_ces_trainings,
                    'noh_ces_trainings' =>  $request->noh_ces_trainings,
                    'barrio_ces_trainings' =>  $request->barrio_ces_trainings,
                    'rs_ces_trainings' =>  $request->rs_ces_trainings,
                    'sd_ces_trainings' =>  $request->sd_ces_trainings,
                    'training_status_ces_trainings' =>  $request->training_status_ces_trainings,
                    'remarks_ces_trainings' =>  Str::ucfirst($request->remarks_ces_trainings),
                    'date_t_ces_trainings' =>  $request->date_t_ces_trainings,
                    'date_f_ces_trainings' =>  $request->date_f_ces_trainings,
                ),
                array(
                    'cesno' => 'required',
                    's_title_ces_trainings' => 'required|max:255',
                    's_no_ces_trainings' => 'required|max:255',
                    'training_category_ces_trainings' => 'required|max:255',
                    'fos_ces_trainings' => 'required|max:255',
                    'venue_ces_trainings' => 'required|max:255',
                    'noh_ces_trainings' => 'required|max:255',
                    'barrio_ces_trainings' => 'required|max:255',
                    'rs_ces_trainings' => 'required|max:255',
                    'sd_ces_trainings' => 'required|max:255',
                    'training_status_ces_trainings' => 'required|max:255',
                    'remarks_ces_trainings' => 'required',
                    'date_t_ces_trainings' => 'required|date',
                    'date_f_ces_trainings' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesTrainings::create([
                    'cesno' => $request->cesno,
                    's_title_ces_trainings' => $request->s_title_ces_trainings,
                    's_no_ces_trainings' =>  $request->s_no_ces_trainings,
                    'training_category_ces_trainings' =>  $request->training_category_ces_trainings,
                    'fos_ces_trainings' =>  $request->fos_ces_trainings,
                    'venue_ces_trainings' =>  $request->venue_ces_trainings,
                    'noh_ces_trainings' =>  $request->noh_ces_trainings,
                    'barrio_ces_trainings' =>  $request->barrio_ces_trainings,
                    'rs_ces_trainings' =>  $request->rs_ces_trainings,
                    'sd_ces_trainings' =>  $request->sd_ces_trainings,
                    'training_status_ces_trainings' =>  $request->training_status_ces_trainings,
                    'remarks_ces_trainings' =>  Str::ucfirst($request->remarks_ces_trainings),
                    'date_t_ces_trainings' =>  $request->date_t_ces_trainings,
                    'date_f_ces_trainings' =>  $request->date_f_ces_trainings,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editCesTrainings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('CES Trainings','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    's_title_ces_trainings' => $request->s_title_ces_trainings,
                    's_no_ces_trainings' =>  $request->s_no_ces_trainings,
                    'training_category_ces_trainings' =>  $request->training_category_ces_trainings,
                    'fos_ces_trainings' =>  $request->fos_ces_trainings,
                    'venue_ces_trainings' =>  $request->venue_ces_trainings,
                    'noh_ces_trainings' =>  $request->noh_ces_trainings,
                    'barrio_ces_trainings' =>  $request->barrio_ces_trainings,
                    'rs_ces_trainings' =>  $request->rs_ces_trainings,
                    'sd_ces_trainings' =>  $request->sd_ces_trainings,
                    'training_status_ces_trainings' =>  $request->training_status_ces_trainings,
                    'remarks_ces_trainings' =>  Str::ucfirst($request->remarks_ces_trainings),
                    'date_t_ces_trainings' =>  $request->date_t_ces_trainings,
                    'date_f_ces_trainings' =>  $request->date_f_ces_trainings,
                ),
                array(
                    's_title_ces_trainings' => 'required|max:255',
                    's_no_ces_trainings' => 'required|max:255',
                    'training_category_ces_trainings' => 'required|max:255',
                    'fos_ces_trainings' => 'required|max:255',
                    'venue_ces_trainings' => 'required|max:255',
                    'noh_ces_trainings' => 'required|max:255',
                    'barrio_ces_trainings' => 'required|max:255',
                    'rs_ces_trainings' => 'required|max:255',
                    'sd_ces_trainings' => 'required|max:255',
                    'training_status_ces_trainings' => 'required|max:255',
                    'remarks_ces_trainings' => 'required',
                    'date_t_ces_trainings' => 'required|date',
                    'date_f_ces_trainings' => 'required|date',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesTrainings::where('id', $request->cesno_ces_trainings_id)
                ->update([
                    's_title_ces_trainings' => $request->s_title_ces_trainings,
                    's_no_ces_trainings' =>  $request->s_no_ces_trainings,
                    'training_category_ces_trainings' =>  $request->training_category_ces_trainings,
                    'fos_ces_trainings' =>  $request->fos_ces_trainings,
                    'venue_ces_trainings' =>  $request->venue_ces_trainings,
                    'noh_ces_trainings' =>  $request->noh_ces_trainings,
                    'barrio_ces_trainings' =>  $request->barrio_ces_trainings,
                    'rs_ces_trainings' =>  $request->rs_ces_trainings,
                    'sd_ces_trainings' =>  $request->sd_ces_trainings,
                    'training_status_ces_trainings' =>  $request->training_status_ces_trainings,
                    'remarks_ces_trainings' =>  Str::ucfirst($request->remarks_ces_trainings),
                    'date_t_ces_trainings' =>  $request->date_t_ces_trainings,
                    'date_f_ces_trainings' =>  $request->date_f_ces_trainings,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getCesTrainings($id){

        if(RolesController::validateUserExecutive201RoleAccess('CES Trainings','Category Only') == 'true'){

            $cestrainings = CesTrainings::where('id','=',$id)->get();

            return $cestrainings;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteCesTrainings($id){

        if(RolesController::validateUserExecutive201RoleAccess('CES Trainings','Delete') == 'true'){

            $cestrainings = CesTrainings::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addOtherManagementTrainings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_f_onat' => $request->date_f_onat,
                    'date_t_onat' =>  $request->date_t_onat,
                    'title_traning_onat' =>  $request->title_traning_onat,
                    'training_category_onat' =>  $request->training_category_onat,
                    'expertise_fos_onat' =>  $request->expertise_fos_onat,
                    'sponsor_tp_onat' =>  $request->sponsor_tp_onat,
                    'vanue_onat' =>  $request->vanue_onat,
                    'no_training_hours_omt' =>  $request->no_training_hours_omt,
                ),
                array(
                    'cesno' => 'required',
                    'date_f_onat' => 'required|date',
                    'date_t_onat' => 'required|date',
                    'title_traning_onat' => 'required|max:255',
                    'training_category_onat' => 'required|max:255',
                    'expertise_fos_onat' => 'required|max:255',
                    'sponsor_tp_onat' => 'required|max:255',
                    'vanue_onat' => 'required|max:255',
                    'no_training_hours_omt' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                OtherManagementTrainings::create([
                    'cesno' => $request->cesno,
                    'date_f_onat' => $request->date_f_onat,
                    'date_t_onat' =>  $request->date_t_onat,
                    'title_traning_onat' =>  $request->title_traning_onat,
                    'training_category_onat' =>  $request->training_category_onat,
                    'expertise_fos_onat' =>  $request->expertise_fos_onat,
                    'sponsor_tp_onat' =>  $request->sponsor_tp_onat,
                    'vanue_onat' =>  $request->vanue_onat,
                    'no_training_hours_omt' =>  $request->no_training_hours_omt,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editOtherManagementTrainings(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_f_onat' => $request->date_f_onat,
                    'date_t_onat' =>  $request->date_t_onat,
                    'title_traning_onat' =>  $request->title_traning_onat,
                    'training_category_onat' =>  $request->training_category_onat,
                    'expertise_fos_onat' =>  $request->expertise_fos_onat,
                    'sponsor_tp_onat' =>  $request->sponsor_tp_onat,
                    'vanue_onat' =>  $request->vanue_onat,
                    'no_training_hours_omt' =>  $request->no_training_hours_omt,
                ),
                array(
                    'date_f_onat' => 'required|date',
                    'date_t_onat' => 'required|date',
                    'title_traning_onat' => 'required|max:255',
                    'training_category_onat' => 'required|max:255',
                    'expertise_fos_onat' => 'required|max:255',
                    'sponsor_tp_onat' => 'required|max:255',
                    'vanue_onat' => 'required|max:255',
                    'no_training_hours_omt' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                OtherManagementTrainings::where('id', $request->cesno_other_management_trainings_id)
                ->update([
                    'date_f_onat' => $request->date_f_onat,
                    'date_t_onat' =>  $request->date_t_onat,
                    'title_traning_onat' =>  $request->title_traning_onat,
                    'training_category_onat' =>  $request->training_category_onat,
                    'expertise_fos_onat' =>  $request->expertise_fos_onat,
                    'sponsor_tp_onat' =>  $request->sponsor_tp_onat,
                    'vanue_onat' =>  $request->vanue_onat,
                    'no_training_hours_omt' =>  $request->no_training_hours_omt,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getOtherManagementTrainings($id){

        if(RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings','Category Only') == 'true'){

            $OtherManagementTrainings = OtherManagementTrainings::where('id','=',$id)->get();

            return $OtherManagementTrainings;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteOtherManagementTrainings($id){

        if(RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings','Delete') == 'true'){

            $OtherManagementTrainings = OtherManagementTrainings::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addResearchAndStudies(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Research and Studies','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_f_ras' => $request->date_f_ras,
                    'date_t_ras' =>  $request->date_t_ras,
                    'title_ras' =>  $request->title_ras,
                    'publisher_ras' =>  $request->publisher_ras,
                ),
                array(
                    'cesno' => 'required',
                    'date_f_ras' => 'required|date',
                    'date_t_ras' => 'required|date',
                    'title_ras' => 'required|max:255',
                    'publisher_ras' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ResearchAndStudies::create([
                    'cesno' => $request->cesno,
                    'date_f_ras' => $request->date_f_ras,
                    'date_t_ras' =>  $request->date_t_ras,
                    'title_ras' =>  $request->title_ras,
                    'publisher_ras' =>  $request->publisher_ras,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editResearchAndStudies(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Research and Studies','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_f_ras' => $request->date_f_ras,
                    'date_t_ras' =>  $request->date_t_ras,
                    'title_ras' =>  $request->title_ras,
                    'publisher_ras' =>  $request->publisher_ras,
                ),
                array(
                    'date_f_ras' => 'required|date',
                    'date_t_ras' => 'required|date',
                    'title_ras' => 'required|max:255',
                    'publisher_ras' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ResearchAndStudies::where('id', $request->cesno_research_and_studies_id)
                ->update([
                    'date_f_ras' => $request->date_f_ras,
                    'date_t_ras' =>  $request->date_t_ras,
                    'title_ras' =>  $request->title_ras,
                    'publisher_ras' =>  $request->publisher_ras,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getResearchAndStudies($id){

        if(RolesController::validateUserExecutive201RoleAccess('Research and Studies','Category Only') == 'true'){

            $ResearchAndStudies = ResearchAndStudies::where('id','=',$id)->get();

            return $ResearchAndStudies;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteResearchAndStudies($id){

        if(RolesController::validateUserExecutive201RoleAccess('Research and Studies','Delete') == 'true'){

            $ResearchAndStudies = ResearchAndStudies::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addScholarships(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Scholarships Received','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_f_scholarships' => $request->date_f_scholarships,
                    'date_t_scholarships' =>  $request->date_t_scholarships,
                    'scholar_type_scholarships' =>  $request->scholar_type_scholarships,
                    'title_scholarships' =>  $request->title_scholarships,
                    'sponsor_scholarships' =>  $request->sponsor_scholarships,
                ),
                array(
                    'cesno' => 'required',
                    'date_f_scholarships' => 'required|date',
                    'date_t_scholarships' => 'required|date',
                    'scholar_type_scholarships' => 'required|max:255',
                    'title_scholarships' => 'required|max:255',
                    'sponsor_scholarships' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Scholarships::create([
                    'cesno' => $request->cesno,
                    'date_f_scholarships' => $request->date_f_scholarships,
                    'date_t_scholarships' =>  $request->date_t_scholarships,
                    'scholar_type_scholarships' =>  $request->scholar_type_scholarships,
                    'title_scholarships' =>  $request->title_scholarships,
                    'sponsor_scholarships' =>  $request->sponsor_scholarships,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editScholarships(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Scholarships Received','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_f_scholarships' => $request->date_f_scholarships,
                    'date_t_scholarships' =>  $request->date_t_scholarships,
                    'scholar_type_scholarships' =>  $request->scholar_type_scholarships,
                    'title_scholarships' =>  $request->title_scholarships,
                    'sponsor_scholarships' =>  $request->sponsor_scholarships,
                ),
                array(
                    'date_f_scholarships' => 'required|date',
                    'date_t_scholarships' => 'required|date',
                    'scholar_type_scholarships' => 'required|max:255',
                    'title_scholarships' => 'required|max:255',
                    'sponsor_scholarships' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Scholarships::where('id', $request->cesno_scholarships_id)
                ->update([
                    'date_f_scholarships' => $request->date_f_scholarships,
                    'date_t_scholarships' =>  $request->date_t_scholarships,
                    'scholar_type_scholarships' =>  $request->scholar_type_scholarships,
                    'title_scholarships' =>  $request->title_scholarships,
                    'sponsor_scholarships' =>  $request->sponsor_scholarships,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getScholarships($id){

        if(RolesController::validateUserExecutive201RoleAccess('Scholarships Received','Category Only') == 'true'){

            $Scholarships = Scholarships::where('id','=',$id)->get();

            return $Scholarships;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteScholarships($id){

        if(RolesController::validateUserExecutive201RoleAccess('Scholarships Received','Delete') == 'true'){

            $Scholarships = Scholarships::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addAffiliations(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_f_mcapa' => $request->date_f_mcapa,
                    'date_t_mcapa' =>  $request->date_t_mcapa,
                    'organization_mcapa' =>  $request->organization_mcapa,
                    'position_mcapa' =>  $request->position_mcapa,
                ),
                array(
                    'cesno' => 'required',
                    'date_f_mcapa' => 'required|date',
                    'date_t_mcapa' => 'required|date',
                    'organization_mcapa' => 'required|max:255',
                    'position_mcapa' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Affiliations::create([
                    'cesno' => $request->cesno,
                    'date_f_mcapa' => $request->date_f_mcapa,
                    'date_t_mcapa' =>  $request->date_t_mcapa,
                    'organization_mcapa' =>  $request->organization_mcapa,
                    'position_mcapa' =>  $request->position_mcapa,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editAffiliations(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_f_mcapa' => $request->date_f_mcapa,
                    'date_t_mcapa' =>  $request->date_t_mcapa,
                    'organization_mcapa' =>  $request->organization_mcapa,
                    'position_mcapa' =>  $request->position_mcapa,
                ),
                array(
                    'date_f_mcapa' => 'required|date',
                    'date_t_mcapa' => 'required|date',
                    'organization_mcapa' => 'required|max:255',
                    'position_mcapa' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Affiliations::where('id', $request->cesno_major_civic_and_professional_affiliations_id)
                ->update([
                    'date_f_mcapa' => $request->date_f_mcapa,
                    'date_t_mcapa' =>  $request->date_t_mcapa,
                    'organization_mcapa' =>  $request->organization_mcapa,
                    'position_mcapa' =>  $request->position_mcapa,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }


    public function getAffiliations($id){

        if(RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations','Category Only') == 'true'){

            $Affiliations = Affiliations::where('id','=',$id)->get();

            return $Affiliations;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteAffiliations($id){
        
        if(RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations','Delete') == 'true'){

            $Affiliations = Affiliations::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addAwardAndCitations(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_aac' => $request->date_aac,
                    'title_of_award_aac' =>  $request->title_of_award_aac,
                    'sponsor_aac' =>  $request->sponsor_aac,
                ),
                array(
                    'cesno' => 'required',
                    'date_aac' => 'required|date',
                    'title_of_award_aac' => 'required|max:255',
                    'sponsor_aac' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                AwardAndCitations::create([
                    'cesno' => $request->cesno,
                    'date_aac' => $request->date_aac,
                    'title_of_award_aac' =>  $request->title_of_award_aac,
                    'sponsor_aac' =>  $request->sponsor_aac,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editAwardAndCitations(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_aac' => $request->date_aac,
                    'title_of_award_aac' =>  $request->title_of_award_aac,
                    'sponsor_aac' =>  $request->sponsor_aac,
                ),
                array(
                    'date_aac' => 'required|date',
                    'title_of_award_aac' => 'required|max:255',
                    'sponsor_aac' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                AwardAndCitations::where('id', $request->cesno_award_and_citations_id)
                ->update([
                    'date_aac' => $request->date_aac,
                    'title_of_award_aac' =>  $request->title_of_award_aac,
                    'sponsor_aac' =>  $request->sponsor_aac,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getAwardAndCitations($id){

        if(RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received','Category Only') == 'true'){

            $AwardAndCitations = AwardAndCitations::where('id','=',$id)->get();

            return $AwardAndCitations;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteAwardAndCitations($id){

        if(RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received','Delete') == 'true'){

            $AwardAndCitations = AwardAndCitations::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addCaseRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Case Records','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'parties_case_records' => $request->parties_case_records,
                    'offence_case_records' =>  $request->offence_case_records,
                    'nature_case_records' =>  $request->nature_case_records,
                    'case_no_case_records' =>  $request->case_no_case_records,
                    'date_field_case_records' =>  $request->date_field_case_records,
                    'vanue_case_records' =>  $request->vanue_case_records,
                    'status_case_records' =>  $request->status_case_records,
                    'dof_case_records' =>  $request->dof_case_records,
                    'decision_case_records' =>  $request->decision_case_records,
                    'remarks_case_records' =>  Str::ucfirst($request->remarks_case_records),
                ),
                array(
                    'cesno' => 'required',
                    'parties_case_records' => 'required|max:255',
                    'offence_case_records' => 'required|max:255',
                    'nature_case_records' => 'required|max:255',
                    'case_no_case_records' => 'required|max:255',
                    'date_field_case_records' => 'required|date',
                    'vanue_case_records' => 'required|max:255',
                    'status_case_records' => 'required|max:255',
                    'dof_case_records' => 'required|date',
                    'decision_case_records' => 'required|max:255',
                    'remarks_case_records' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CaseRecords::create([
                    'cesno' => $request->cesno,
                    'parties_case_records' => $request->parties_case_records,
                    'offence_case_records' =>  $request->offence_case_records,
                    'nature_case_records' =>  $request->nature_case_records,
                    'case_no_case_records' =>  $request->case_no_case_records,
                    'date_field_case_records' =>  $request->date_field_case_records,
                    'vanue_case_records' =>  $request->vanue_case_records,
                    'status_case_records' =>  $request->status_case_records,
                    'dof_case_records' =>  $request->dof_case_records,
                    'decision_case_records' =>  $request->decision_case_records,
                    'remarks_case_records' =>  Str::ucfirst($request->remarks_case_records),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editCaseRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Case Records','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'parties_case_records' => $request->parties_case_records,
                    'offence_case_records' =>  $request->offence_case_records,
                    'nature_case_records' =>  $request->nature_case_records,
                    'case_no_case_records' =>  $request->case_no_case_records,
                    'date_field_case_records' =>  $request->date_field_case_records,
                    'vanue_case_records' =>  $request->vanue_case_records,
                    'status_case_records' =>  $request->status_case_records,
                    'dof_case_records' =>  $request->dof_case_records,
                    'decision_case_records' =>  $request->decision_case_records,
                    'remarks_case_records' =>  Str::ucfirst($request->remarks_case_records),
                ),
                array(
                    'parties_case_records' => 'required|max:255',
                    'offence_case_records' => 'required|max:255',
                    'nature_case_records' => 'required|max:255',
                    'case_no_case_records' => 'required|max:255',
                    'date_field_case_records' => 'required|date',
                    'vanue_case_records' => 'required|max:255',
                    'status_case_records' => 'required|max:255',
                    'dof_case_records' => 'required|date',
                    'decision_case_records' => 'required|max:255',
                    'remarks_case_records' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CaseRecords::where('id', $request->cesno_case_records_id)
                ->update([
                    'parties_case_records' => $request->parties_case_records,
                    'offence_case_records' =>  $request->offence_case_records,
                    'nature_case_records' =>  $request->nature_case_records,
                    'case_no_case_records' =>  $request->case_no_case_records,
                    'date_field_case_records' =>  $request->date_field_case_records,
                    'vanue_case_records' =>  $request->vanue_case_records,
                    'status_case_records' =>  $request->status_case_records,
                    'dof_case_records' =>  $request->dof_case_records,
                    'decision_case_records' =>  $request->decision_case_records,
                    'remarks_case_records' =>  Str::ucfirst($request->remarks_case_records),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getCaseRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Case Records','Category Only') == 'true'){

            $CaseRecords = CaseRecords::where('id','=',$id)->get();

            return $CaseRecords;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteCaseRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Case Records','Delete') == 'true'){

            $CaseRecords = CaseRecords::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addHealthRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'mcfdpra_hr' => $request->mcfdpra_hr,
                    'blood_type_hr' =>  $request->blood_type_hr,
                    'identify_marks_hr' =>  Str::ucfirst($request->identify_marks_hr),
                ),
                array(
                    'cesno' => 'required',
                    'mcfdpra_hr' => 'required|max:255',
                    'blood_type_hr' => 'required|max:255',
                    'identify_marks_hr' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                HealthRecords::create([
                    'cesno' => $request->cesno,
                    'mcfdpra_hr' => $request->mcfdpra_hr,
                    'blood_type_hr' =>  $request->blood_type_hr,
                    'identify_marks_hr' =>  Str::ucfirst($request->identify_marks_hr),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editHealthRecords(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'mcfdpra_hr' => $request->mcfdpra_hr,
                    'blood_type_hr' =>  $request->blood_type_hr,
                    'identify_marks_hr' =>  Str::ucfirst($request->identify_marks_hr),
                ),
                array(
                    'mcfdpra_hr' => 'required|max:255',
                    'blood_type_hr' => 'required|max:255',
                    'identify_marks_hr' => 'required|max:255',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                HealthRecords::where('id', $request->cesno_health_records_magna_carta_for_disabled_persons_id)
                ->update([
                    'mcfdpra_hr' => $request->mcfdpra_hr,
                    'blood_type_hr' =>  $request->blood_type_hr,
                    'identify_marks_hr' =>  Str::ucfirst($request->identify_marks_hr),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getHealthRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Category Only') == 'true'){

            $HealthRecords = HealthRecords::where('id','=',$id)->get();

            return $HealthRecords;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteHealthRecords($id){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Delete') == 'true'){

            $HealthRecords = HealthRecords::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addHistoricalRecordOfMedicalCondition(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'date_hronc' => $request->date_hronc,
                    'mci_hronc' =>  $request->mci_hronc,
                    'notes_hronc' =>  Str::ucfirst($request->notes_hronc),
                ),
                array(
                    'cesno' => 'required',
                    'date_hronc' => 'required|date',
                    'mci_hronc' => 'required|max:255',
                    'notes_hronc' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                HistoricalRecordOfMedicalCondition::create([
                    'cesno' => $request->cesno,
                    'date_hronc' => $request->date_hronc,
                    'mci_hronc' =>  $request->mci_hronc,
                    'notes_hronc' =>  Str::ucfirst($request->notes_hronc),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editHistoricalRecordOfMedicalCondition(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Edit') == 'true'){
        
            // Validate form

            $validator = Validator::make(
                    
                array(
                    'date_hronc' => $request->date_hronc,
                    'mci_hronc' =>  $request->mci_hronc,
                    'notes_hronc' =>  Str::ucfirst($request->notes_hronc),
                ),
                array(
                    'date_hronc' => 'required|date',
                    'mci_hronc' => 'required|max:255',
                    'notes_hronc' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                HistoricalRecordOfMedicalCondition::where('id', $request->cesno_health_records_historical_record_of_medical_condition_id)
                ->update([
                    'date_hronc' => $request->date_hronc,
                    'mci_hronc' =>  $request->mci_hronc,
                    'notes_hronc' =>  Str::ucfirst($request->notes_hronc),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getHistoricalRecordOfMedicalCondition($id){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Category Only') == 'true'){

            $HistoricalRecordOfMedicalCondition = HistoricalRecordOfMedicalCondition::where('id','=',$id)->get();

            return $HistoricalRecordOfMedicalCondition;
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteHistoricalRecordOfMedicalCondition($id){

        if(RolesController::validateUserExecutive201RoleAccess('Health Record','Delete') == 'true'){

            $HistoricalRecordOfMedicalCondition = HistoricalRecordOfMedicalCondition::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function addPdfFiles(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Attached PDF Files','Add') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'cesno' => $request->cesno,
                    'pdflink' =>  $request->pdflink,
                    'validated' => $request->validated,
                    'remarks_pdf_files' => $request->remarks_pdf_files,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ),
                array(
                    'cesno' => 'required',
                    'pdflink' => 'required|mimetypes:application/pdf',
                    'validated' => 'required',
                    'remarks_pdf_files' => 'required',
                    'encoder' => '',
                    'last_updated_by' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                // Set relevant path
                
                if($request->validated == 'No'){

                    $relevant_path_pdf_files = 'PDF Documents/201 Folder/For Validation/';
                }
                else if($request->validated == 'Yes'){

                    $relevant_path_pdf_files = 'PDF Documents/201 Folder/'.date('Y').'/';
                }

                if($request->hasFile('pdflink')){

                    // Get file details

                    $filename_with_ext = $request->file('pdflink')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('pdflink')->getClientOriginalExtension();

                    Storage::disk('f-drive')->putFileAs($relevant_path_pdf_files, $request->file('pdflink'), date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension);

                    $pdflink_file_name = date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension;

                }
                else{
                
                    $pdflink_file_name = '';  
                }   

                PdfLinks::create([
                    'cesno' => $request->cesno,
                    'relevant_path_pdf_files' => $relevant_path_pdf_files,
                    'pdflink' => $pdflink_file_name,
                    'validated' => $request->validated,
                    'remarks_pdf_files' => Str::ucfirst($request->remarks_pdf_files),
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);
        
                return 'Successfully added';

            }
        }
        else{

            return 'Restricted';
        }
    }

    public function editPdfFiles(Request $request){

        if(RolesController::validateUserExecutive201RoleAccess('Attached PDF Files','Edit') == 'true'){

            // Validate form

            $validator = Validator::make(
                    
                array(
                    'pdflink' =>  $request->pdflink,
                    'validated' => $request->validated,
                    'remarks_pdf_files' => $request->remarks_pdf_files,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ),
                array(
                    'pdflink' => 'required|mimetypes:application/pdf',
                    'validated' => 'required',
                    'remarks_pdf_files' => 'required',
                    'last_updated_by' => '',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

            
                // Get pdflink file name and relevant path

                $PdfLinks = PdfLinks::where('id','=',$request->cesno_pdf_files_id)->get();
                $PdfLinks_pdflink_file_name = $PdfLinks[0]->pdflink;
                $PdfLinks_pdflink_relevant_path = $PdfLinks[0]->relevant_path_pdf_files;

                // Set relevant path
                
                if($request->validated == 'No'){

                    if($PdfLinks_pdflink_relevant_path == '' && $PdfLinks_pdflink_file_name != ''){

                        $current_relevant_path_pdf_files = 'PDF Documents/201 Folder/';
                        $relevant_path_pdf_files = 'PDF Documents/201 Folder/For Validation/';
                    }
                    else{

                        $current_relevant_path_pdf_files = $PdfLinks_pdflink_relevant_path;
                        $relevant_path_pdf_files = 'PDF Documents/201 Folder/For Validation/';
                    }
                }
                else if($request->validated == 'Yes'){

                    if($PdfLinks_pdflink_relevant_path == '' && $PdfLinks_pdflink_file_name != ''){

                        $current_relevant_path_pdf_files = 'PDF Documents/201 Folder/';
                        $relevant_path_pdf_files = 'PDF Documents/201 Folder/';
                    }
                    else{

                        $current_relevant_path_pdf_files = $PdfLinks_pdflink_relevant_path;
                        $relevant_path_pdf_files = 'PDF Documents/201 Folder/'.date('Y').'/';
                    }   
                }

                if($request->hasFile('pdflink')){

                    // Get file details

                    $filename_with_ext = $request->file('pdflink')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('pdflink')->getClientOriginalExtension();

                    // Delete pdflink file

                    if(Storage::disk('f-drive')->exists($current_relevant_path_pdf_files.$PdfLinks_pdflink_file_name)){

                        Storage::disk('f-drive')->delete($current_relevant_path_pdf_files.$PdfLinks_pdflink_file_name);
                    }

                    Storage::disk('f-drive')->putFileAs($relevant_path_pdf_files, $request->file('pdflink'), date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension);

                    $pdflink_file_name = date('Y_m_d_H_i_s').'_('.$request->cesno.')_'.$filename.'.'.$extension;

                }
                else{
                
                    $pdflink_file_name = $PdfLinks_pdflink_file_name;  
                }   

                PdfLinks::where('id', $request->cesno_pdf_files_id)
                ->update([
                    'relevant_path_pdf_files' => $relevant_path_pdf_files,
                    'pdflink' => $pdflink_file_name,
                    'validated' => $request->validated,
                    'remarks_pdf_files' => Str::ucfirst($request->remarks_pdf_files),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);
        
                return 'Successfully updated';

            }
        }
        else{

            return 'Restricted';
        }
    }

    public function getPdfFiles($id){

        if(RolesController::validateUserExecutive201RoleAccess('Attached PDF Files','Category Only') == 'true'){

            $PdfLinks = PdfLinks::where('id','=',$id)->get();

            return $PdfLinks;
        }
        else{

            return 'Restricted';
        }
    }

    public function deletePdfFiles($id){

        if(RolesController::validateUserExecutive201RoleAccess('Attached PDF Files','Delete') == 'true'){

            // Get pdflink file name

            $PdfLinks = PdfLinks::where('id','=',$id)->get();
            $PdfLinks_pdflink_file_name = $PdfLinks[0]->pdflink;
            $PdfLinks_pdflink_relevant_path = $PdfLinks[0]->relevant_path_pdf_files;

            // Set relevant path
            
            if($PdfLinks_pdflink_relevant_path == '' && $PdfLinks_pdflink_file_name != ''){

                $relevant_path_pdf_files = 'PDF Documents/201 Folder/';
            }
            else{

                $relevant_path_pdf_files = $PdfLinks_pdflink_relevant_path;
            }  

            // Delete pdflink file

            if(Storage::disk('f-drive')->exists($relevant_path_pdf_files.$PdfLinks_pdflink_file_name)){

                Storage::disk('f-drive')->delete($relevant_path_pdf_files.$PdfLinks_pdflink_file_name);
            }

            $PdfLinks = PdfLinks::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }    
}
