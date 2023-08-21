<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatedNewAccountMail;

use App\Models\PersonalData;
use App\Models\SpouseRecords;
use App\Models\Father;
use App\Models\Addresses;
use App\Models\EducationalAttainment;
use App\Models\ExaminationsTaken;
use App\Models\ProfileTblCesStatus;
use App\Models\ProfileTblLanguages;
use App\Models\ProfileTblWorkExperience;
use App\Models\ProfileTblExpertise;
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
use App\Models\Identification;
use App\Models\Mother;
use App\Models\User;
use App\Models\PdfLinks;
use App\Models\ProfileAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
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
use App\Models\Country;
use App\Models\IndigenousGroup;
use App\Models\PWD;
use App\Models\GenderByChoice;
use App\Models\GenderByBirth;
use App\Models\NameExtension;
use App\Models\CivilStatus;
use App\Models\MedicalHistory;
use App\Models\Title;
use App\Models\RecordStatus;
use App\Models\Religion;
use DateTime;
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

        $recipientEmail = $request->email;
        $password = Str::password(8);
        $hashedPassword = Hash::make($password);
        $imagePath = public_path('images/branding.png');

        $data = [
            'email' => $recipientEmail,
            'password' => $password,
            'imagePath' => $imagePath,
        ];

        Mail::to($recipientEmail)->send(new TempCred201($data));

        $user = $newProfile->users()->Create([
            'email' => $newProfile->email,
            'password' => $hashedPassword,
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => $encoder,
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('user');

        return back()->with('message','New profile added!'.$encoder);

    }

    public function viewProfile($cesno)
    {
        $mainProfile = PersonalData::find($cesno);
        $father = Father::where('personal_data_cesno', $cesno)->get();
        $mother = Mother::where('personal_data_cesno', $cesno)->get();
        $childrenRecords = ChildrenRecords::where('personal_data_cesno', $cesno)->get();
        $SpouseRecords = SpouseRecords::where('personal_data_cesno', $cesno)->get();
        $identification = Identification::where('personal_data_cesno', $cesno)->first();
        $addressProfile = ProfileAddress::where('personal_data_cesno', $cesno)->get();
        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();
        $caseRecord = PersonalData::find($cesno)->caseRecords;
        $healthRecord = HealthRecords::where('personal_data_cesno', $cesno)->first();
        $language = PersonalData::find($cesno)->languages;

        $personalData = PersonalData::find($cesno);
        $language = $personalData->languages;
        $healthRecord = $personalData->healthRecords;
        $caseRecord = $personalData->caseRecords;

        $addressProfilePermanent = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Permanent')->first();
        $addressProfileMailing = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Mailing')->first();
        $addressProfileTemp = ProfileAddress::where('personal_data_cesno', $cesno)->where('type', 'Temporary')->first();
        $nameExtensions = NameExtension::all();
        $pwds = PWD::all();
        $medicalHistory = MedicalHistory::where('personal_data_cesno', $cesno)->get();
        $birthdate = $mainProfile->birth_date;
        $now = new DateTime();
        $birthDate = new DateTime($birthdate);
        $age = $now->diff($birthDate)->y;

        return view('admin.201_profiling.view_profile.profile', compact('mainProfile', 'father', 'childrenRecords', 'SpouseRecords', 
        'addressProfile','mother', 'identification', 'healthRecord', 'profileLibTblLanguageRef', 'language', 'addressProfilePermanent',
        'addressProfileMailing', 'addressProfileTemp', 'age', 'nameExtensions', 'pwds', 'medicalHistory'));

    }

}