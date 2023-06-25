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