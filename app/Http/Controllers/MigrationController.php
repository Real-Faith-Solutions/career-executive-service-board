<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalData;
use App\Models\SpouseRecords;
use App\Models\ChildrenRecords;
use App\Models\FamilyProfile;
use App\Models\EducationalAttainment;
use App\Models\ExaminationsTaken;
use App\Models\LicenseDetails;
use App\Models\LanguagesDialects;
use App\Models\CesWe;
use App\Models\AssessmentCenter;
use App\Models\ValidationHr;
use App\Models\BoardInterview;
use App\Models\CesStatus;
use App\Models\RecordOfCespesRatings;
use App\Models\ProfileTblWorkExperience;
use App\Models\profileTblExpertise;
use App\Models\CesTrainings;
use App\Models\training_tblparticipants;
use App\Models\training_tblSessions;
use App\Models\OtherManagementTrainings;
use App\Models\ResearchAndStudies;
use App\Models\Scholarships;
use App\Models\Affiliations;
use App\Models\AwardAndCitations;
use App\Models\CaseRecords;
use App\Models\HealthRecords;
use App\Models\HistoricalRecordOfMedicalCondition;
use App\Models\PdfLinks;
use App\Models\ProfileLibTblAreaCode;
use App\Models\ProfileLibTblEducDegree;
use App\Models\ProfileLibTblEducMajor;
use App\Models\ProfileLibTblEducSchool;

class MigrationController extends Controller
{

    public function getMigrationSystemPage(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            $DatabaseMigrations = DatabaseMigrations::get();

            return view('admin.system_utility.database_migration', compact('DatabaseMigrations'))->render();

        }
        else{

            return view('restricted');
        }
    }

    public function getDatabaseMigrations($updated_category){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            $DatabaseMigrations = DatabaseMigrations::where('updated_category','=',$updated_category)->select('updated_category')->get();

            if($DatabaseMigrations == '[]'){

                $status = 'false';
            }
            else{

                $status = 'true';
            }
            
            return $status;

        }
        else{

            return 'Restricted';
        }
    }

    public function migratePersonalData(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset database_migrations table
            DatabaseMigrations::truncate();

            // Reset personal_data table
            PersonalData::truncate();

            $start = new \DateTime();

            $vw_profile_main = DB::connection('sqlsrv-2')->table('vw_profile_main')->get();

            foreach($vw_profile_main as $item){

                $profile_tblAddress = DB::connection('sqlsrv-2')->table('profile_tblAddress')->where('cesno','=',$item->cesno)->where('catid','=','Home')->get();

                PersonalData::create([

                    'cesno' => $item->cesno,
                    'sp' => null,
                    'moig' => null,
                    'pwd' => null,
                    'title' => $item->title,
                    'picture' => $item->picture,
                    'gsis' => null,
                    'pagibig' => null,
                    'philhealt' => null,
                    'sss_no' => null,
                    'tin' => null,
                    'status' => $item->status,
                    'citizenship' => $item->civilstatus,
                    'd_citizenship' => null,
                    'lastname' => $item->lastname,
                    'firstname' => $item->firstname,
                    'middlename' => $item->middlename,
                    'mi' => $item->middleinitial,
                    'ne' => null,
                    'nickname' => $item->nickname,
                    'birthdate' => $item->birthdate,
                    'age' => null,
                    'birth_place' => $item->birthplace,
                    'gender' => $item->gender,
                    'civil_status' => $item->civilstatus,
                    'religion' => $item->religion,
                    'height' => $item->height,
                    'weight' => $item->weight,
                    'fb_pa' => ($profile_tblAddress == '[]' ? '' : $profile_tblAddress[0]->house_bldg),
                    'ns_pa' => ($profile_tblAddress == '[]' ? '' : $profile_tblAddress[0]->st_road),
                    'bd_pa' => ($profile_tblAddress == '[]' ? '' : $profile_tblAddress[0]->brgy_vill),
                    'cm_pa' => ($profile_tblAddress == '[]' ? '' : $profile_tblAddress[0]->city_code),
                    'zc_pa' => null,
                    'fb_ma' => null,
                    'ns_ma' => null,
                    'bd_ma' => null,
                    'cm_ma' => null,
                    'zc_ma' => null,
                    'oea_ma' => $item->emailadd,
                    'telno1_ma' => $item->telno,
                    'mobileno1_ma' => $item->mobileno,
                    'mobileno2_ma' => $item->mobileno2,
                    'acno' => $item->acno,
                    'remarks' => $item->remarks,
                    'cesstat_code' => $item->CESStat_Code,
                    'mailingaddr' => $item->mailingaddr,
                    'last_updated_by' => $item->lastupd_encoder,
                    'created_at' => $item->e_date,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,

                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Personal Data',
                'table_source' => 'vw_profile_main,profile_tblAddress',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateFamilyProfileSpouse(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset spouse_records table
            SpouseRecords::truncate();

            // Reset family_profiles table
            FamilyProfile::truncate();

            $start = new \DateTime();

            $vw_profile_main = DB::connection('sqlsrv-2')->table('vw_profile_main')->get();

            foreach($vw_profile_main as $item){

                SpouseRecords::create([
                    'cesno' => $item->cesno,
                    'lastname_sn_fp' => $item->spouse_lname,
                    'first_sn_fp' => $item->spouse_fname,
                    'middlename_sn_fp' => $item->spouse_mname,
                    'ne_sn_fp' => null,
                    'occu_sn_fp' => null,
                    'ebn_sn_fp' => null,
                    'eba_sn_fp' => null,
                    'etn_sn_fp' => null,
                    'civil_status_sn_fp' => null,
                    'gender_sn_fp' => null,
                    'birthdate_sn_fp' => null,
                    'age_sn_fp' => null,
                    'last_updated_by' => $item->lastupd_encoder,
                    'created_at' => $item->e_date,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,              
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Family Profile Spouse',
                'table_source' => 'vw_profile_main,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateFamilyProfileChildren(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset children_records table
            ChildrenRecords::truncate();

            // Reset family_profiles table
            FamilyProfile::truncate();

            $start = new \DateTime();

            $profile_tblChildren = DB::connection('sqlsrv-2')->table('profile_tblChildren')->get();

            foreach($profile_tblChildren as $item){

                ChildrenRecords::create([
                    'cesno' => $item->cesno,
                    'ch_lastname_fp' => $item->lname,
                    'ch_first_fp' => $item->fname,
                    'ch_middlename_fp' => $item->mname,
                    'ch_ne_fp' => null,
                    'ch_gender_fp' => $item->gender,
                    'ch_birthdate_fp' => $item->bdate,
                    'ch_birthplace_fp' => null,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,           
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Family Profile Children',
                'table_source' => 'profile_tblChildren,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateEducationalBackgroundOrAttainment(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset educational_attainments table
            EducationalAttainment::truncate();

            $start = new \DateTime();

            $profile_tblEducation = DB::connection('sqlsrv-2')->table('profile_tblEducation')->get();

            foreach($profile_tblEducation as $item){

                EducationalAttainment::create([
                    'cesno' => $item->cesno,
                    'level_ea' => null,
                    'school_ea' => $item->school_code,
                    'degree_ea' => $item->degree_code,
                    'date_grad_ea' => $item->year_grad,
                    'ms_ea' => $item->major_code,
                    'school_type_ea' => $item->school_status,
                    'date_f_ea' => null,
                    'date_t_ea' => null,
                    'hlu_ea' => null,
                    'ahr_ea' => $item->honors,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,         
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Educational Background or Attainment',
                'table_source' => 'profile_tblEducation,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateExaminationsTaken(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset examinations_takens table
            ExaminationsTaken::truncate();

            // Reset license_details table
            LicenseDetails::truncate();

            $start = new \DateTime();

            $profile_tblExaminations = DB::connection('sqlsrv-2')->table('profile_tblExaminations')->get();

            foreach($profile_tblExaminations as $item){

                ExaminationsTaken::create([
                    'cesno' => $item->cesno,
                    'tox_et' => $item->exam_code,
                    'rating_et' => $item->rate,
                    'doe_et' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'poe_et' => $item->exam_place,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,       
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Examinations Taken',
                'table_source' => 'profile_tblExaminations,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateLanguageDialects(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset languages_dialects table
            LanguagesDialects::truncate();

            $start = new \DateTime();

            $profile_tblLanguages = DB::connection('sqlsrv-2')->table('profile_tblLanguages')->get();

            foreach($profile_tblLanguages as $item){

                LanguagesDialects::create([
                    'cesno' => $item->cesno,
                    'lang_languages_dialects' => $item->lang_code,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,      
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Language Dialects',
                'table_source' => 'profile_tblLanguages,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateERISCESWE(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset ces_wes table
            CesWe::truncate();

            $start = new \DateTime();

            $erad_tblWExam = DB::connection('sqlsrv-2')->table('erad_tblWExam')->get();

            foreach($erad_tblWExam as $item){

                CesWe::create([
                    'cesno' => null,
                    'ed_ces_we' => $item->we_date,
                    'r_ces_we' => $item->we_rating,
                    'rd_ces_we' => null,
                    'poe_ces_we' => $item->we_location,
                    'tn_ces_we' => null,
                    'acno' => $item->acno,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,   
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'ERIS CES WE',
                'table_source' => 'erad_tblWExam,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateERISAssessmentCenter(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset assessment_centers table
            AssessmentCenter::truncate();

            $start = new \DateTime();

            $erad_tblAC = DB::connection('sqlsrv-2')->table('erad_tblAC')->get();

            foreach($erad_tblAC as $item){

                AssessmentCenter::create([
                    'cesno' => null,
                    'an_achr_ces_we' => $item->acno,
                    'ad_achr_ces_we' => $item->acdate,
                    'r_achr_ces_we' => null,
                    'cfd_achr_ces_we' => null,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'ERIS Assessment Center',
                'table_source' => 'erad_tblAC,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateERISValidationInDepthAndRapid(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset validation_hrs table
            ValidationHr::truncate();

            $start = new \DateTime();

            $erad_tblRVP = DB::connection('sqlsrv-2')->table('erad_tblRVP')->get();
            $erad_tblIVP = DB::connection('sqlsrv-2')->table('erad_tblIVP')->get();

            foreach($erad_tblRVP as $item){

                ValidationHr::create([
                    'cesno' => null,
                    'vd_vhr_ces_we' => $item->dteassign,
                    'tov_vhr_ces_we' => 'Rapid',
                    'r_vhr_ces_we' => null,
                    'acno' => $item->acno,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            foreach($erad_tblIVP as $item){

                ValidationHr::create([
                    'cesno' => null,
                    'vd_vhr_ces_we' => $item->dteassign,
                    'tov_vhr_ces_we' => 'In-Dept',
                    'r_vhr_ces_we' => null,
                    'acno' => $item->acno,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'ERIS Validation In-depth and Rapid',
                'table_source' => 'erad_tblRVP,erad_tblIVP',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateERISBoardInterview(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset board_interviews table
            BoardInterview::truncate();

            $start = new \DateTime();

            $erad_tblBOARD = DB::connection('sqlsrv-2')->table('erad_tblBOARD')->get();
            $erad_tblPBOARD = DB::connection('sqlsrv-2')->table('erad_tblPBOARD')->get();

            foreach($erad_tblBOARD as $item){

                BoardInterview::create([
                    'cesno' => null,
                    'bid_bi_ces_we' => $item->dteassign,
                    'r_bi_ces_we' => null,
                    'type_of_interview' => 'Board',
                    'acno' => $item->acno,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            foreach($erad_tblPBOARD as $item){

                BoardInterview::create([
                    'cesno' => null,
                    'bid_bi_ces_we' => $item->dteassign,
                    'r_bi_ces_we' => null,
                    'type_of_interview' => 'Panel Board',
                    'acno' => $item->acno,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'ERIS Board Interview',
                'table_source' => 'erad_tblBOARD,erad_tblPBOARD',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateCESStatus(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset ces_statuses table
            CesStatus::truncate();

            $start = new \DateTime();

            $profile_tblCESstatus = DB::connection('sqlsrv-2')->table('profile_tblCESstatus')->get();

            foreach($profile_tblCESstatus as $item){

                CesStatus::create([
                    'cesno' => $item->cesno,
                    'cs_cs_ces_we' => $item->cesstat_code,
                    'at_cs_ces_we' => $item->acc_code,
                    'st_cs_ces_we' => $item->type_code,
                    'aa_cs_ces_we' => $item->official_code,
                    'rn_cs_ces_we' => $item->resolution_no,
                    'da_cs_ces_we' => $item->appointed_dt,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'CES Status',
                'table_source' => 'profile_tblCESstatus,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateRecordOfCespesRatings(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset record_of_cespes_ratings table
            RecordOfCespesRatings::truncate();

            $start = new \DateTime();

            $cespes_tblRatingPeriod = DB::connection('sqlsrv-2')->table('cespes_tblRatingPeriod')->get();

            foreach($cespes_tblRatingPeriod as $item){

                RecordOfCespesRatings::create([
                    'cesno' => $item->cesno,
                    'date_from_rocr' => $item->from_dt,
                    'date_to_rocr' => $item->to_dt,
                    'rating_rocr' => null,
                    'status_rocr' => null,
                    'remarks_rocr' => null,
                    'pdf_rating_certificate_rocr' => null,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Record of Cespes Ratings',
                'table_source' => 'cespes_tblRatingPeriod,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateWorkExperience(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset work_experiences table
            ProfileTblWorkExperience::truncate();

            $start = new \DateTime();

            $profile_tblWorkExperience = DB::connection('sqlsrv-2')->table('profile_tblWorkExperience')->get();

            foreach($profile_tblWorkExperience as $item){

                ProfileTblWorkExperience::create([
                    'cesno' => $item->cesno,
                    'date_from_work_experience' => $item->from_dt,
                    'date_to_work_experience' => $item->to_dt,
                    'destination_from_work_experience' => $item->designation,
                    'status_from_work_experience' => $item->status,
                    'salary_from_work_experience' => $item->salary,
                    'salary_job_pay_grade_work_experience' => null,
                    'status_of_appointment_work_experience' => null,
                    'government_service_work_experience' => null,
                    'department_from_work_experience' => $item->department,
                    'remarks_from_work_experience' => $item->remarks,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Work Experience',
                'table_source' => 'profile_tblWorkExperience,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateFieldExpertise(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset field_expertises table
            ProfileTblWorkExperience::truncate();

            $start = new \DateTime();

            $profile_tblExpertise = DB::connection('sqlsrv-2')->table('profile_tblExpertise')->get();

            foreach($profile_tblExpertise as $item){

                ProfileTblWorkExperience::create([
                    'cesno' => $item->cesno,
                    'ec_field_expertise' => null,
                    'ss_field_expertise' => $item->SpeExp_Code,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Field Expertise',
                'table_source' => 'profile_tblExpertise,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateCESTrainings(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset ces_trainings,training_tbl_sessions, and training_tblparticipants table
            CesTrainings::truncate();
            training_tblparticipants::truncate();
            training_tblSessions::truncate();

            $start = new \DateTime();

            $training_tblparticipants = DB::connection('sqlsrv-2')->table('training_tblparticipants')->get();
            $training_tblSessions = DB::connection('sqlsrv-2')->table('training_tblSessions')->get();

            foreach($training_tblparticipants as $item){

                training_tblparticipants::create([
                    'pid' => $item->pid,
                    'sessionid' => $item->sessionid,
                    'cesno' => $item->cesno,
                    'cesstat_code' => null,
                    'status' => $item->status,
                    'remarks' => $item->remarks,
                    'no_hours' => $item->no_hours,
                    'payment' => $item->payment,
                    'encoder' => $item->encoder,
                    'created_at' => $item->encoder_dt,
                    'updated_at' => $item->lastupd_dt,
                    'lastupd_enc' => $item->lastupd_enc,
                ]);

            }

            foreach($training_tblSessions as $item){

                training_tblSessions::create([
                    'sessionid' => $item->sessionid,
                    'title' => $item->title,
                    'category' => $item->category,
                    'specialization' => $item->specialization,
                    'from_dt' => $item->from_dt,
                    'to_dt' => $item->to_dt,
                    'venueid' => $item->venueid,
                    'status' => $item->status,
                    'remarks' => $item->remarks,
                    'barrio' => $item->barrio,
                    'no_hours' => $item->no_hours,
                    'session_director' => $item->session_director,
                    'speakerid' => $item->speakerid,
                    'encoder' => $item->encoder,
                    'created_at' => $item->encoder_dt,
                    'lastupd_enc' => $item->lastupd_enc,
                    'updated_at' => $item->lastupd_dt,
                ]);

            }

            foreach($training_tblparticipants as $participant){

                foreach($training_tblSessions as $item){

                    if($participant->sessionid == $item->sessionid){

                        CesTrainings::create([
                            'cesno' => $participant->cesno,
                            'date_f_ces_trainings' => $item->from_dt,
                            'date_t_ces_trainings' => $item->to_dt,
                            's_title_ces_trainings' => $item->title,
                            's_no_ces_trainings' => $participant->sessionid,
                            'training_category_ces_trainings' => $item->category,
                            'fos_ces_trainings' => $item->specialization,
                            'venue_ces_trainings' => $item->venueid,
                            'noh_ces_trainings' => $item->no_hours,
                            'barrio_ces_trainings' => $item->barrio,
                            'rs_ces_trainings' => $item->speakerid,
                            'sd_ces_trainings' => $item->session_director,
                            'training_status_ces_trainings' => $item->status,
                            'remarks_ces_trainings' => $item->remarks,
                            'last_updated_by' => $item->lastupd_enc,
                            'created_at' => $item->encoder_dt,
                            'updated_at' => $item->lastupd_dt,
                            'encoder' => $item->encoder,
                        ]);

                    }
                }
                
            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'CECMS Training Session and Participant for CES Trainings',
                'table_source' => 'training_tblSessions,training_tblparticipants,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateOtherNonCESAccreditedTrainings(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset other_management_trainings table
            OtherManagementTrainings::truncate();

            $start = new \DateTime();

            $profile_tblTrainingMngt = DB::connection('sqlsrv-2')->table('profile_tblTrainingMngt')->get();

            foreach($profile_tblTrainingMngt as $item){

                OtherManagementTrainings::create([
                    'cesno' => $item->cesno,
                    'date_f_onat' => $item->from_dt,
                    'date_t_onat' => $item->to_dt,
                    'title_traning_onat' => $item->training,
                    'training_category_onat' => null,
                    'expertise_fos_onat' => $item->classcode,
                    'sponsor_tp_onat' => $item->sponsor,
                    'vanue_onat' => $item->venue,
                    'no_training_hours_omt' => null,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Other Non-CES Accredited Trainings',
                'table_source' => 'profile_tblTrainingMngt,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateResearchAndStudies(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset research_and_studies table
            ResearchAndStudies::truncate();

            $start = new \DateTime();

            $profile_tblResearch = DB::connection('sqlsrv-2')->table('profile_tblResearch')->get();

            foreach($profile_tblResearch as $item){

                ResearchAndStudies::create([
                    'cesno' => $item->cesno,
                    'date_f_ras' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'date_t_ras' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'title_ras' => $item->title,
                    'publisher_ras' => $item->sponsor,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Research and Studies',
                'table_source' => 'profile_tblResearch,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateScholarshipsReceived(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset scholarships table
            Scholarships::truncate();

            $start = new \DateTime();

            $profile_tblScholarship = DB::connection('sqlsrv-2')->table('profile_tblScholarship')->get();

            foreach($profile_tblScholarship as $item){

                Scholarships::create([
                    'cesno' => $item->cesno,
                    'date_f_scholarships' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'date_t_scholarships' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'scholar_type_scholarships' => $item->type,
                    'title_scholarships' => $item->title,
                    'sponsor_scholarships' => $item->sponsor,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Scholarships Received',
                'table_source' => 'profile_tblScholarship,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateMajorCivicAndProfessionalAffiliations(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset affiliations table
            Affiliations::truncate();

            $start = new \DateTime();

            $profile_tblAffiliations = DB::connection('sqlsrv-2')->table('profile_tblAffiliations')->get();

            foreach($profile_tblAffiliations as $item){

                Affiliations::create([
                    'cesno' => $item->cesno,
                    'date_f_mcapa' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'date_t_mcapa' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'organization_mcapa' => $item->organization,
                    'position_mcapa' => $item->position,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Major Civic and Professional Affiliations',
                'table_source' => 'profile_tblAffiliations,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateAwardsAndCitationsReceived(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset award_and_citations table
            AwardAndCitations::truncate();

            $start = new \DateTime();

            $profile_tblAwards = DB::connection('sqlsrv-2')->table('profile_tblAwards')->get();

            foreach($profile_tblAwards as $item){

                AwardAndCitations::create([
                    'personal_data_cesno' => $item->cesno,
                    'date_aac' => null, // Changed to null due to error migration invalid date datatype from legacy source
                    'title_of_award_aac' => $item->awards,
                    'sponsor_aac' => $item->sponsor,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Awards and Citations Received',
                'table_source' => 'profile_tblAwards,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateCaseRecords(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset case_records table
            CaseRecords::truncate();

            $start = new \DateTime();

            $profile_tblCaseRecord = DB::connection('sqlsrv-2')->table('profile_tblCaseRecord')->get();

            foreach($profile_tblCaseRecord as $item){

                CaseRecords::create([
                    'cesno' => $item->cesno,
                    'parties_case_records' => $item->parties,
                    'offence_case_records' => $item->offence,
                    'nature_case_records' => $item->nature_code,
                    'case_no_case_records' => $item->case_no,
                    'date_field_case_records' => $item->filed_dt,
                    'vanue_case_records' => $item->venue,
                    'status_case_records' => $item->status_code,
                    'dof_case_records' => $item->finality,
                    'decision_case_records' => $item->decision,
                    'remarks_case_records' => $item->remarks,
                    'last_updated_by' => $item->lastupd_enc,
                    'created_at' => $item->encdate,
                    'updated_at' => $item->lastupd_dt,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Case Records',
                'table_source' => 'profile_tblCaseRecord,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateHealthRecord(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset health_records and historical_record_of_medical_conditions table
            HealthRecords::truncate();
            HistoricalRecordOfMedicalCondition::truncate();

            $start = new \DateTime();

            $profile_tblHealthRecord = DB::connection('sqlsrv-2')->table('profile_tblHealthRecord')->get();

            foreach($profile_tblHealthRecord as $item){

                if($item->handicap != '' || $item->marks != ''){

                    HealthRecords::create([
                        'cesno' => $item->cesno,
                        'mcfdpra_hr' => $item->handicap,
                        'blood_type_hr' => null,
                        'identify_marks_hr' => $item->marks,
                        'last_updated_by' => $item->lastupd_enc,
                        'created_at' => $item->encdate,
                        'updated_at' => $item->lastupd_dt,
                        'encoder' => $item->encoder,
                    ]);

                }

            }

            foreach($profile_tblHealthRecord as $item){

                if($item->illness != ''){

                    HistoricalRecordOfMedicalCondition::create([
                        'cesno' => $item->cesno,
                        'date_hronc' => $item->ill_dt,
                        'mci_hronc' => $item->illness,
                        'notes_hronc' => null,
                        'last_updated_by' => $item->lastupd_enc,
                        'created_at' => $item->encdate,
                        'updated_at' => $item->lastupd_dt,
                        'encoder' => $item->encoder,
                    ]);

                }

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Health Record',
                'table_source' => 'profile_tblHealthRecord,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrateAttachedPDFFiles(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset pdf_links table
            PdfLinks::truncate();

            $start = new \DateTime();

            $profile_tblmain_pdflink = DB::connection('sqlsrv-2')->table('profile_tblmain_pdflink')->get();

            foreach($profile_tblmain_pdflink as $item){

                PdfLinks::create([
                    'cesno' => $item->cesno,
                    'relevant_path_pdf_files' => null,
                    'pdflink' => $item->pdflink,
                    'validated' => null,
                    'remarks_pdf_files' => $item->remarks,
                    'last_updated_by' => null,
                    'created_at' => $item->encdate,
                    'updated_at' => null,
                    'encoder' => $item->encoder,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => 'Attached PDF Files',
                'table_source' => 'profile_tblmain_pdflink,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrate201LibraryAddressCityMunicipality(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset ProfileLibTblAreaCodes table
            ProfileLibTblAreaCode::truncate();

            $start = new \DateTime();

            $ProfileLibTblAreaCode = DB::connection('sqlsrv-2')->table('ProfileLibTblAreaCode')->get();

            foreach($ProfileLibTblAreaCode as $item){

                ProfileLibTblAreaCode::create([
                    'CODE' => $item->CODE,
                    'NAME' => $item->NAME,
                    'ZIPCODE' => $item->ZIPCODE,
                    'encoder' => null,
                    'created_at' => null,
                    'updated_at' => null,
                    'lastupd_enc' => null,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => '201 Library - Address (City-Municipality)',
                'table_source' => 'ProfileLibTblAreaCode,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrate201LibraryEducationDegree(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset profilelib_tbl_educ_degrees table
            ProfileLibTblEducDegree::truncate();

            $start = new \DateTime();

            $ProfileLibTblEducDegree = DB::connection('sqlsrv-2')->table('ProfileLibTblEducDegree')->get();

            foreach($ProfileLibTblEducDegree as $item){

                ProfileLibTblEducDegree::create([
                    'CODE' => round($item->CODE),
                    'DEGREE' => $item->DEGREE,
                    'encoder' => null,
                    'created_at' => null,
                    'updated_at' => null,
                    'lastupd_enc' => null,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => '201 Library - Education (Degree)',
                'table_source' => 'ProfileLibTblEducDegree,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrate201LibraryEducationCourseMajor(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset profilelib_tbl_educ_majors table
            ProfileLibTblEducMajor::truncate();

            $start = new \DateTime();

            $ProfileLibTblEducMajor = DB::connection('sqlsrv-2')->table('ProfileLibTblEducMajor')->get();

            foreach($ProfileLibTblEducMajor as $item){

                ProfileLibTblEducMajor::create([
                    'CODE' => round($item->CODE),
                    'COURSE' => $item->COURSE,
                    'encoder' => null,
                    'created_at' => null,
                    'updated_at' => null,
                    'lastupd_enc' => null,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => '201 Library - Education (Course Major)',
                'table_source' => 'ProfileLibTblEducMajor,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }

    public function migrate201LibraryEducationSchool(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true'){

            // Reset profilelib_tbl_educ_schools table
            ProfileLibTblEducSchool::truncate();

            $start = new \DateTime();

            $ProfileLibTblEducSchool = DB::connection('sqlsrv-2')->table('ProfileLibTblEducSchool')->get();

            foreach($ProfileLibTblEducSchool as $item){

                ProfileLibTblEducSchool::create([
                    'CODE' => $item->CODE,
                    'SCHOOL' => $item->SCHOOL,
                    'encoder' => null,
                    'created_at' => null,
                    'updated_at' => null,
                    'lastupd_enc' => null,
                ]);

            }

            $finish = new \DateTime();

            DatabaseMigrations::create([

                'updated_category' => '201 Library - Education (School)',
                'table_source' => 'ProfileLibTblEducSchool,',
                'start' => $start,
                'finish' => $finish,
                'duration_in_minutes' => $start->diff($finish)->format('%I'),
                'migration_status' => 'Success',
                'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,

            ]);

            return 'Successfully Migrated';
        }
        else{

            return 'Restricted';
        }
    }
}
