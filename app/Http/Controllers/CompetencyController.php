<?php

namespace App\Http\Controllers;
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
use App\Models\PdfLinks;
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

use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    public function viewCompetency(Request $request) {

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Competency') == 'true'){

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

            return view('admin.competency_managemengt_system.compentency_manager', compact('search', 'searched', 'personalData', 'SpouseRecords', 'FamilyProfile', 'ChildrenRecords', 'EducationalAttainment','ExaminationsTaken','LicenseDetails','LanguagesDialects',
            'CesWe','AssessmentCenter','ValidationHr','BoardInterview','CesStatus','RecordOfCespesRatings','WorkExperience','FieldExpertise','CesTrainings','OtherManagementTrainings',
            'ResearchAndStudies','Scholarships','Affiliations','AwardAndCitations','CaseRecords','HealthRecords','HistoricalRecordOfMedicalCondition','PdfLinks','CityMunicipality','Degree','CourseMajor','School','ExaminationReference','LanguageDialects','CesStatusReference',
            'AcquiredThru','StatusType','AppointingAuthority','ExpertiseCategory','SpecialSkill','CaseNature','CaseStatus','LocationCity','LocationProvince','LocationRegion'))->render();

        }
        else{

            return view('restricted');
        }
    }
}