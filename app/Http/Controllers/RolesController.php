<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Executive201RoleAccess;
use App\Models\CesWebAppGeneralPageAccess;
use App\Models\PlantillaManangementAccess;
use App\Models\ReportGenerationAccess;
use App\Models\User;


class RolesController extends Controller
{
    
    public function putSeparator($value){

        // Put Separator on value
        
        if(!empty($value)){
            return $value.',';
        }
        else{
            return '';
        }

    }

    public function putVerticalLineSeparator($value){

        // Put Vertical Line Separator on value
        
        if(!empty($value)){
            return $value.'|';
        }
        else{
            return '';
        }

    }

    public static function validateUserCesWebAppGeneralPageAccess($value){

        $ces_web_app_general_page_access = CesWebAppGeneralPageAccess::where('role_name_ces_web_app_general_page','=',Auth::user()->role)->where('ces_web_app_general_page_access','like',"%$value%")->select('ces_web_app_general_page_access')->get();
        
        if($ces_web_app_general_page_access != '[]'){

            $ces_web_app_general_page_access_items = $ces_web_app_general_page_access[0]->ces_web_app_general_page_access;

            foreach(explode(',',$ces_web_app_general_page_access_items) as $item){
                
                if($item == $value){

                    return 'true';
                }
                
            }
        }
    }

    public static function validateUserRepGenExecutive201ProfileAccess($value){

        $rep_gen_executive_201_profile_access = ReportGenerationAccess::where('role_name_report_generation','=',Auth::user()->role)->where('rep_gen_executive_201_profile_access','like',"%$value%")->select('rep_gen_executive_201_profile_access')->get();
        
        if($rep_gen_executive_201_profile_access != '[]'){

            $rep_gen_executive_201_profile_access_items = $rep_gen_executive_201_profile_access[0]->rep_gen_executive_201_profile_access;

            foreach(explode('|',$rep_gen_executive_201_profile_access_items) as $item){
                
                if($item == $value){

                    return 'true';
                }
                
            }
        }
    }

    public static function validateUserRepGenCompetencyTrainingManagementSubModuleAccess($value){

        $rep_gen_competency_training_management_sub_module_access = ReportGenerationAccess::where('role_name_report_generation','=',Auth::user()->role)->where('rep_gen_competency_training_management_sub_module_access','like',"%$value%")->select('rep_gen_competency_training_management_sub_module_access')->get();
        
        if($rep_gen_competency_training_management_sub_module_access != '[]'){

            $rep_gen_competency_training_management_sub_module_access_items = $rep_gen_competency_training_management_sub_module_access[0]->rep_gen_competency_training_management_sub_module_access;

            foreach(explode('|',$rep_gen_competency_training_management_sub_module_access_items) as $item){
                
                if($item == $value){

                    return 'true';
                }
                
            }
        }
    }

    public static function validateUserRepGenEligibilityAndRankTrackingAccess($value){

        $rep_gen_eligibility_and_rank_tracking_access = ReportGenerationAccess::where('role_name_report_generation','=',Auth::user()->role)->where('rep_gen_eligibility_and_rank_tracking_access','like',"%$value%")->select('rep_gen_eligibility_and_rank_tracking_access')->get();
        
        if($rep_gen_eligibility_and_rank_tracking_access != '[]'){

            $rep_gen_eligibility_and_rank_tracking_access_items = $rep_gen_eligibility_and_rank_tracking_access[0]->rep_gen_eligibility_and_rank_tracking_access;

            foreach(explode('|',$rep_gen_eligibility_and_rank_tracking_access_items) as $item){
                
                if($item == $value){

                    return 'true';
                }
                
            }
        }
    }

    public static function validateUserRepGenPlantillaManagementReportsAccess($value){

        $rep_gen_plantilla_management_reports_access = ReportGenerationAccess::where('role_name_report_generation','=',Auth::user()->role)->where('rep_gen_plantilla_management_reports_access','like',"%$value%")->select('rep_gen_plantilla_management_reports_access')->get();
        
        if($rep_gen_plantilla_management_reports_access != '[]'){

            $rep_gen_plantilla_management_reports_access_items = $rep_gen_plantilla_management_reports_access[0]->rep_gen_plantilla_management_reports_access;

            foreach(explode('|',$rep_gen_plantilla_management_reports_access_items) as $item){
                
                if($item == $value){

                    return 'true';
                }
                
            }
        }
    }

    public static function validateUserPlantillaManangementAccess($category, $rights){

        if($rights == 'Category Only'){

            $plantilla_manangement_page_access = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('plantilla_manangement_page_access','like',"%$category%")->select('plantilla_manangement_page_access')->get();
        
            if($plantilla_manangement_page_access != '[]'){

                $plantilla_manangement_page_access_items = $plantilla_manangement_page_access[0]->plantilla_manangement_page_access;

                foreach(explode(',',$plantilla_manangement_page_access_items) as $item){
                    
                    if($item == $category){

                        return 'true';
                    }
                    
                }
            }
        }
        else{

            if($category == 'Plantilla Management (Main Screen)'){

                $plantilla_management_main_screen_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('plantilla_management_main_screen_rights','like',"%$rights%")->select('plantilla_management_main_screen_rights')->get();
        
                if($plantilla_management_main_screen_rights != '[]'){

                    $plantilla_management_main_screen_rights_items = $plantilla_management_main_screen_rights[0]->plantilla_management_main_screen_rights;

                    foreach(explode(',',$plantilla_management_main_screen_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Sector Manager'){

                $sector_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('sector_manager_rights','like',"%$rights%")->select('sector_manager_rights')->get();
        
                if($sector_manager_rights != '[]'){

                    $sector_manager_rights_items = $sector_manager_rights[0]->sector_manager_rights;

                    foreach(explode(',',$sector_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }

            }
            else if($category == 'Department or Agency Manager'){

                $department_agency_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('department_agency_manager_rights','like',"%$rights%")->select('department_agency_manager_rights')->get();
        
                if($department_agency_manager_rights != '[]'){

                    $department_agency_manager_rights_items = $department_agency_manager_rights[0]->department_agency_manager_rights;

                    foreach(explode(',',$department_agency_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Agency Location Manager'){

                $agency_location_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('agency_location_manager_rights','like',"%$rights%")->select('agency_location_manager_rights')->get();
        
                if($agency_location_manager_rights != '[]'){

                    $agency_location_manager_rights_items = $agency_location_manager_rights[0]->agency_location_manager_rights;

                    foreach(explode(',',$agency_location_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Office Manager'){

                $office_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('office_manager_rights','like',"%$rights%")->select('office_manager_rights')->get();
        
                if($office_manager_rights != '[]'){

                    $office_manager_rights_items = $office_manager_rights[0]->office_manager_rights;

                    foreach(explode(',',$office_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Plantilla Position Manager'){

                $plantilla_position_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('plantilla_position_manager_rights','like',"%$rights%")->select('plantilla_position_manager_rights')->get();
        
                if($plantilla_position_manager_rights != '[]'){

                    $plantilla_position_manager_rights_items = $plantilla_position_manager_rights[0]->plantilla_position_manager_rights;

                    foreach(explode(',',$plantilla_position_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Plantilla Position Classification Manager'){

                $plantilla_position_classification_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('plantilla_position_classification_manager_rights','like',"%$rights%")->select('plantilla_position_classification_manager_rights')->get();
        
                if($plantilla_position_classification_manager_rights != '[]'){

                    $plantilla_position_classification_manager_rights_items = $plantilla_position_classification_manager_rights[0]->plantilla_position_classification_manager_rights;

                    foreach(explode(',',$plantilla_position_classification_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Appointee - Occupant Manager'){

                $appointee_occupant_manager_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('appointee_occupant_manager_rights','like',"%$rights%")->select('appointee_occupant_manager_rights')->get();
        
                if($appointee_occupant_manager_rights != '[]'){

                    $appointee_occupant_manager_rights_items = $appointee_occupant_manager_rights[0]->appointee_occupant_manager_rights;

                    foreach(explode(',',$appointee_occupant_manager_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Plantilla Appointee or Occupant Browser'){

                $plantilla_appointee_occupant_browser_rights = PlantillaManangementAccess::where('role_name_plantilla_manangement','=',Auth::user()->role)->where('plantilla_appointee_occupant_browser_rights','like',"%$rights%")->select('plantilla_appointee_occupant_browser_rights')->get();
        
                if($plantilla_appointee_occupant_browser_rights != '[]'){

                    $plantilla_appointee_occupant_browser_rights_items = $plantilla_appointee_occupant_browser_rights[0]->plantilla_appointee_occupant_browser_rights;

                    foreach(explode(',',$plantilla_appointee_occupant_browser_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
        }

    }

    public static function validateUserExecutive201RoleAccess($category, $rights){

        if($rights == 'Category Only'){

            $executive_201_page_access = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('executive_201_page_access','like',"%$category%")->select('executive_201_page_access')->get();
        
            if($executive_201_page_access != '[]'){

                $executive_201_page_access_items = $executive_201_page_access[0]->executive_201_page_access;

                foreach(explode(',',$executive_201_page_access_items) as $item){
                    
                    if($item == $category){

                        return 'true';
                    }
                    
                }
            }
        }
        else{

            if($category == 'Personal Data'){

                $personal_data_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('personal_data_rights','like',"%$rights%")->select('personal_data_rights')->get();
        
                if($personal_data_rights != '[]'){

                    $personal_data_rights_items = $personal_data_rights[0]->personal_data_rights;

                    foreach(explode(',',$personal_data_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Family Background Profile'){

                $family_background_profile_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('family_background_profile_rights','like',"%$rights%")->select('family_background_profile_rights')->get();
        
                if($family_background_profile_rights != '[]'){

                    $family_background_profile_rights_items = $family_background_profile_rights[0]->family_background_profile_rights;

                    foreach(explode(',',$family_background_profile_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }

            }
            else if($category == 'Educational Background or Attainment'){

                $educational_background_attainment_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('educational_background_attainment_rights','like',"%$rights%")->select('educational_background_attainment_rights')->get();
        
                if($educational_background_attainment_rights != '[]'){

                    $educational_background_attainment_rights_items = $educational_background_attainment_rights[0]->educational_background_attainment_rights;

                    foreach(explode(',',$educational_background_attainment_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Examinations Taken'){

                $examinations_taken_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('examinations_taken_rights','like',"%$rights%")->select('examinations_taken_rights')->get();
        
                if($examinations_taken_rights != '[]'){

                    $examinations_taken_rights_items = $examinations_taken_rights[0]->examinations_taken_rights;

                    foreach(explode(',',$examinations_taken_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Language Dialects'){

                $language_dialects_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('language_dialects_rights','like',"%$rights%")->select('language_dialects_rights')->get();
        
                if($language_dialects_rights != '[]'){

                    $language_dialects_rights_items = $language_dialects_rights[0]->language_dialects_rights;

                    foreach(explode(',',$language_dialects_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Eligibility and Rank Tracker'){

                $eligibility_and_rank_tracker_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('eligibility_and_rank_tracker_rights','like',"%$rights%")->select('eligibility_and_rank_tracker_rights')->get();
        
                if($eligibility_and_rank_tracker_rights != '[]'){

                    $eligibility_and_rank_tracker_rights_items = $eligibility_and_rank_tracker_rights[0]->eligibility_and_rank_tracker_rights;

                    foreach(explode(',',$eligibility_and_rank_tracker_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Record of CESPES Ratings'){

                $record_of_cespes_ratings_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('record_of_cespes_ratings_rights','like',"%$rights%")->select('record_of_cespes_ratings_rights')->get();
        
                if($record_of_cespes_ratings_rights != '[]'){

                    $record_of_cespes_ratings_rights_items = $record_of_cespes_ratings_rights[0]->record_of_cespes_ratings_rights;

                    foreach(explode(',',$record_of_cespes_ratings_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Work Experience'){

                $work_experience_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('work_experience_rights','like',"%$rights%")->select('work_experience_rights')->get();
        
                if($work_experience_rights != '[]'){

                    $work_experience_rights_items = $work_experience_rights[0]->work_experience_rights;

                    foreach(explode(',',$work_experience_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Records of Field of Expertise or Specialization'){

                $records_of_field_of_expertise_specialization_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('records_of_field_of_expertise_specialization_rights','like',"%$rights%")->select('records_of_field_of_expertise_specialization_rights')->get();
        
                if($records_of_field_of_expertise_specialization_rights != '[]'){

                    $records_of_field_of_expertise_specialization_rights_items = $records_of_field_of_expertise_specialization_rights[0]->records_of_field_of_expertise_specialization_rights;

                    foreach(explode(',',$records_of_field_of_expertise_specialization_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'CES Trainings'){

                $ces_trainings_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('ces_trainings_rights','like',"%$rights%")->select('ces_trainings_rights')->get();
        
                if($ces_trainings_rights != '[]'){

                    $ces_trainings_rights_items = $ces_trainings_rights[0]->ces_trainings_rights;

                    foreach(explode(',',$ces_trainings_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Other Non-CES Accredited Trainings'){

                $other_non_ces_accredited_trainings_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('other_non_ces_accredited_trainings_rights','like',"%$rights%")->select('other_non_ces_accredited_trainings_rights')->get();
        
                if($other_non_ces_accredited_trainings_rights != '[]'){

                    $other_non_ces_accredited_trainings_rights_items = $other_non_ces_accredited_trainings_rights[0]->other_non_ces_accredited_trainings_rights;

                    foreach(explode(',',$other_non_ces_accredited_trainings_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Research and Studies'){

                $research_and_studies_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('research_and_studies_rights','like',"%$rights%")->select('research_and_studies_rights')->get();
        
                if($research_and_studies_rights != '[]'){

                    $research_and_studies_rights_items = $research_and_studies_rights[0]->research_and_studies_rights;

                    foreach(explode(',',$research_and_studies_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Scholarships Received'){

                $scholarships_received_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('scholarships_received_rights','like',"%$rights%")->select('scholarships_received_rights')->get();
        
                if($scholarships_received_rights != '[]'){

                    $scholarships_received_rights_items = $scholarships_received_rights[0]->scholarships_received_rights;

                    foreach(explode(',',$scholarships_received_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Major Civic and Professional Affiliations'){

                $major_civic_and_professional_affiliations_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('major_civic_and_professional_affiliations_rights','like',"%$rights%")->select('major_civic_and_professional_affiliations_rights')->get();
        
                if($major_civic_and_professional_affiliations_rights != '[]'){

                    $major_civic_and_professional_affiliations_rights_items = $major_civic_and_professional_affiliations_rights[0]->major_civic_and_professional_affiliations_rights;

                    foreach(explode(',',$major_civic_and_professional_affiliations_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Awards and Citations Received'){

                $awards_and_citations_received_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('awards_and_citations_received_rights','like',"%$rights%")->select('awards_and_citations_received_rights')->get();
        
                if($awards_and_citations_received_rights != '[]'){

                    $awards_and_citations_received_rights_items = $awards_and_citations_received_rights[0]->awards_and_citations_received_rights;

                    foreach(explode(',',$awards_and_citations_received_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Case Records'){

                $case_records_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('case_records_rights','like',"%$rights%")->select('case_records_rights')->get();
        
                if($case_records_rights != '[]'){

                    $case_records_rights_items = $case_records_rights[0]->case_records_rights;

                    foreach(explode(',',$case_records_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Health Record'){

                $health_record_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('health_record_rights','like',"%$rights%")->select('health_record_rights')->get();
        
                if($health_record_rights != '[]'){

                    $health_record_rights_items = $health_record_rights[0]->health_record_rights;

                    foreach(explode(',',$health_record_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
            else if($category == 'Attached PDF Files'){

                $attached_pdf_files_rights = Executive201RoleAccess::where('role_name','=',Auth::user()->role)->where('attached_pdf_files_rights','like',"%$rights%")->select('attached_pdf_files_rights')->get();
        
                if($attached_pdf_files_rights != '[]'){

                    $attached_pdf_files_rights_items = $attached_pdf_files_rights[0]->attached_pdf_files_rights;

                    foreach(explode(',',$attached_pdf_files_rights_items) as $item){
                        
                        if($item == $rights){

                            return 'true';
                        }
                        
                    }
                }
            }
        }

    }

    public function addRolesPage(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $executive_201_role_access = Executive201RoleAccess::all();
            $ces_web_app_general_page_access = CesWebAppGeneralPageAccess::all();
            $plantilla_manangement_access = PlantillaManangementAccess::all();
            $report_generation_access = ReportGenerationAccess::all();
            
            return view('admin.rights_management.roles', compact('executive_201_role_access','ces_web_app_general_page_access','plantilla_manangement_access','report_generation_access'))->render();
        }
        else{

            return view('restricted');
        }
    }

    public function getRolesAccess(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $Executive201RoleAccess = Executive201RoleAccess::all();
            $CesWebAppGeneralPageAccess = CesWebAppGeneralPageAccess::all();
            $PlantillaManangementAccess = PlantillaManangementAccess::all();
            $ReportGenerationAccess = ReportGenerationAccess::all();

            return compact('Executive201RoleAccess','CesWebAppGeneralPageAccess','PlantillaManangementAccess','ReportGenerationAccess');
        }
        else{

            return 'Restricted';
        }
    }

    public function addExecutive201RoleAccess(Request $request){
        
        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'role_name' => $request->role_name,
                    'executive_201_page_access' => $request->personal_data.$request->family_background_profile.$request->educational_background_attainment.$request->examinations_taken.$request->language_dialects.$request->eligibility_and_rank_tracker.$request->record_of_cespes_ratings.$request->work_experience.$request->records_of_field_of_expertise_specialization.$request->ces_trainings.$request->other_non_ces_accredited_trainings.$request->research_and_studies.$request->scholarships_received.$request->major_civic_and_professional_affiliations.$request->awards_and_citations_received.$request->case_records.$request->health_record.$request->attached_pdf_files,
                    'personal_data' => $request->personal_data,
                    'family_background_profile' => $request->family_background_profile,
                    'educational_background_attainment' => $request->educational_background_attainment,
                    'examinations_taken' => $request->examinations_taken,
                    'language_dialects' => $request->language_dialects,
                    'eligibility_and_rank_tracker' => $request->eligibility_and_rank_tracker,
                    'record_of_cespes_ratings' => $request->record_of_cespes_ratings,
                    'work_experience' => $request->work_experience,
                    'records_of_field_of_expertise_specialization' => $request->records_of_field_of_expertise_specialization,
                    'ces_trainings' => $request->ces_trainings,
                    'other_non_ces_accredited_trainings' => $request->other_non_ces_accredited_trainings,
                    'research_and_studies' => $request->research_and_studies,
                    'scholarships_received' => $request->scholarships_received,
                    'major_civic_and_professional_affiliations' => $request->major_civic_and_professional_affiliations,
                    'awards_and_citations_received' => $request->awards_and_citations_received,
                    'case_records' => $request->case_records,
                    'health_record' => $request->health_record,
                    'attached_pdf_files' => $request->attached_pdf_files,
                    'personal_data_rights' => $request->personal_data_rights_add.$request->personal_data_rights_edit.$request->personal_data_rights_delete.$request->personal_data_rights_view_only,
                    'family_background_profile_rights' => $request->family_background_profile_rights_add.$request->family_background_profile_rights_edit.$request->family_background_profile_rights_delete.$request->family_background_profile_rights_view_only,
                    'educational_background_attainment_rights' => $request->educational_background_attainment_rights_add.$request->educational_background_attainment_rights_edit.$request->educational_background_attainment_rights_delete.$request->educational_background_attainment_rights_view_only,
                    'examinations_taken_rights' => $request->examinations_taken_rights_add.$request->examinations_taken_rights_edit.$request->examinations_taken_rights_delete.$request->examinations_taken_rights_view_only,
                    'language_dialects_rights' => $request->language_dialects_rights_add.$request->language_dialects_rights_edit.$request->language_dialects_rights_delete.$request->language_dialects_rights_view_only,
                    'eligibility_and_rank_tracker_rights' => $request->eligibility_and_rank_tracker_rights_add.$request->eligibility_and_rank_tracker_rights_edit.$request->eligibility_and_rank_tracker_rights_delete.$request->eligibility_and_rank_tracker_rights_view_only,
                    'record_of_cespes_ratings_rights' => $request->record_of_cespes_ratings_rights_add.$request->record_of_cespes_ratings_rights_edit.$request->record_of_cespes_ratings_rights_delete.$request->record_of_cespes_ratings_rights_view_only,
                    'work_experience_rights' => $request->work_experience_rights_add.$request->work_experience_rights_edit.$request->work_experience_rights_delete.$request->work_experience_rights_view_only,
                    'records_of_field_of_expertise_specialization_rights' => $request->records_of_field_of_expertise_specialization_rights_add.$request->records_of_field_of_expertise_specialization_rights_edit.$request->records_of_field_of_expertise_specialization_rights_delete.$request->records_of_field_of_expertise_specialization_rights_view_only,
                    'ces_trainings_rights' => $request->ces_trainings_rights_add.$request->ces_trainings_rights_edit.$request->ces_trainings_rights_delete.$request->ces_trainings_rights_view_only,
                    'other_non_ces_accredited_trainings_rights' => $request->other_non_ces_accredited_trainings_rights_add.$request->other_non_ces_accredited_trainings_rights_edit.$request->other_non_ces_accredited_trainings_rights_delete.$request->other_non_ces_accredited_trainings_rights_view_only,
                    'research_and_studies_rights' => $request->research_and_studies_rights_add.$request->research_and_studies_rights_edit.$request->research_and_studies_rights_delete.$request->research_and_studies_rights_view_only,
                    'scholarships_received_rights' => $request->scholarships_received_rights_add.$request->scholarships_received_rights_edit.$request->scholarships_received_rights_delete.$request->scholarships_received_rights_view_only,
                    'major_civic_and_professional_affiliations_rights' => $request->major_civic_and_professional_affiliations_rights_add.$request->major_civic_and_professional_affiliations_rights_edit.$request->major_civic_and_professional_affiliations_rights_delete.$request->major_civic_and_professional_affiliations_rights_view_only,
                    'awards_and_citations_received_rights' => $request->awards_and_citations_received_rights_add.$request->awards_and_citations_received_rights_edit.$request->awards_and_citations_received_rights_delete.$request->awards_and_citations_received_rights_view_only,
                    'case_records_rights' => $request->case_records_rights_add.$request->case_records_rights_edit.$request->case_records_rights_delete.$request->case_records_rights_view_only,
                    'health_record_rights' => $request->health_record_rights_add.$request->health_record_rights_edit.$request->health_record_rights_delete.$request->health_record_rights_view_only,
                    'attached_pdf_files_rights' => $request->attached_pdf_files_rights_add.$request->attached_pdf_files_rights_edit.$request->attached_pdf_files_rights_delete.$request->attached_pdf_files_rights_view_only,
                ),
                array(
                    'role_name' => 'required|unique:executive201_role_accesses',
                    'executive_201_page_access' => 'required',
                    'personal_data' => 'required_with:personal_data_rights',
                    'family_background_profile' => 'required_with:family_background_profile_rights',
                    'educational_background_attainment' => 'required_with:educational_background_attainment_rights',
                    'examinations_taken' => 'required_with:examinations_taken_rights',
                    'language_dialects' => 'required_with:language_dialects_rights',
                    'eligibility_and_rank_tracker' => 'required_with:eligibility_and_rank_tracker_rights',
                    'record_of_cespes_ratings' => 'required_with:record_of_cespes_ratings_rights',
                    'work_experience' => 'required_with:work_experience_rights',
                    'records_of_field_of_expertise_specialization' => 'required_with:records_of_field_of_expertise_specialization_rights',
                    'ces_trainings' => 'required_with:ces_trainings_rights',
                    'other_non_ces_accredited_trainings' => 'required_with:other_non_ces_accredited_trainings_rights',
                    'research_and_studies' => 'required_with:research_and_studies_rights',
                    'scholarships_received' => 'required_with:scholarships_received_rights',
                    'major_civic_and_professional_affiliations' => 'required_with:major_civic_and_professional_affiliations_rights',
                    'awards_and_citations_received' => 'required_with:awards_and_citations_received_rights',
                    'case_records' => 'required_with:case_records_rights',
                    'health_record' => 'required_with:health_record_rights',
                    'attached_pdf_files' => 'required_with:attached_pdf_files_rights',
                    'personal_data_rights' => 'required_with:personal_data',
                    'family_background_profile_rights' => 'required_with:family_background_profile',
                    'educational_background_attainment_rights' => 'required_with:educational_background_attainment',
                    'examinations_taken_rights' => 'required_with:examinations_taken',
                    'language_dialects_rights' => 'required_with:language_dialects',
                    'eligibility_and_rank_tracker_rights' => 'required_with:eligibility_and_rank_tracker',
                    'record_of_cespes_ratings_rights' => 'required_with:record_of_cespes_ratings',
                    'work_experience_rights' => 'required_with:work_experience',
                    'records_of_field_of_expertise_specialization_rights' => 'required_with:records_of_field_of_expertise_specialization',
                    'ces_trainings_rights' => 'required_with:ces_trainings',
                    'other_non_ces_accredited_trainings_rights' => 'required_with:other_non_ces_accredited_trainings',
                    'research_and_studies_rights' => 'required_with:research_and_studies',
                    'scholarships_received_rights' => 'required_with:scholarships_received',
                    'major_civic_and_professional_affiliations_rights' => 'required_with:major_civic_and_professional_affiliations',
                    'awards_and_citations_received_rights' => 'required_with:awards_and_citations_received',
                    'case_records_rights' => 'required_with:case_records',
                    'health_record_rights' => 'required_with:health_record',
                    'attached_pdf_files_rights' => 'required_with:attached_pdf_files',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Executive201RoleAccess::create([
                    'role_name' => $request->role_name,
                    'executive_201_page_access' => RolesController::putSeparator($request->personal_data).RolesController::putSeparator($request->family_background_profile).RolesController::putSeparator($request->educational_background_attainment).RolesController::putSeparator($request->examinations_taken).RolesController::putSeparator($request->language_dialects).RolesController::putSeparator($request->eligibility_and_rank_tracker).RolesController::putSeparator($request->record_of_cespes_ratings).RolesController::putSeparator($request->work_experience).RolesController::putSeparator($request->records_of_field_of_expertise_specialization).RolesController::putSeparator($request->ces_trainings).RolesController::putSeparator($request->other_non_ces_accredited_trainings).RolesController::putSeparator($request->research_and_studies).RolesController::putSeparator($request->scholarships_received).RolesController::putSeparator($request->major_civic_and_professional_affiliations).RolesController::putSeparator($request->awards_and_citations_received).RolesController::putSeparator($request->case_records).RolesController::putSeparator($request->health_record).RolesController::putSeparator($request->attached_pdf_files),
                    'personal_data_rights' => RolesController::putSeparator($request->personal_data_rights_add).RolesController::putSeparator($request->personal_data_rights_edit).RolesController::putSeparator($request->personal_data_rights_delete).RolesController::putSeparator($request->personal_data_rights_view_only),
                    'family_background_profile_rights' => RolesController::putSeparator($request->family_background_profile_rights_add).RolesController::putSeparator($request->family_background_profile_rights_edit).RolesController::putSeparator($request->family_background_profile_rights_delete).RolesController::putSeparator($request->family_background_profile_rights_view_only),
                    'educational_background_attainment_rights' => RolesController::putSeparator($request->educational_background_attainment_rights_add).RolesController::putSeparator($request->educational_background_attainment_rights_edit).RolesController::putSeparator($request->educational_background_attainment_rights_delete).RolesController::putSeparator($request->educational_background_attainment_rights_view_only),
                    'examinations_taken_rights' => RolesController::putSeparator($request->examinations_taken_rights_add).RolesController::putSeparator($request->examinations_taken_rights_edit).RolesController::putSeparator($request->examinations_taken_rights_delete).RolesController::putSeparator($request->examinations_taken_rights_view_only),
                    'language_dialects_rights' => RolesController::putSeparator($request->language_dialects_rights_add).RolesController::putSeparator($request->language_dialects_rights_edit).RolesController::putSeparator($request->language_dialects_rights_delete).RolesController::putSeparator($request->language_dialects_rights_view_only),
                    'eligibility_and_rank_tracker_rights' => RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_add).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_edit).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_delete).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_view_only),
                    'record_of_cespes_ratings_rights' => RolesController::putSeparator($request->record_of_cespes_ratings_rights_add).RolesController::putSeparator($request->record_of_cespes_ratings_rights_edit).RolesController::putSeparator($request->record_of_cespes_ratings_rights_delete).RolesController::putSeparator($request->record_of_cespes_ratings_rights_view_only),
                    'work_experience_rights' => RolesController::putSeparator($request->work_experience_rights_add).RolesController::putSeparator($request->work_experience_rights_edit).RolesController::putSeparator($request->work_experience_rights_delete).RolesController::putSeparator($request->work_experience_rights_view_only),
                    'records_of_field_of_expertise_specialization_rights' => RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_add).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_edit).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_delete).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_view_only),
                    'ces_trainings_rights' => RolesController::putSeparator($request->ces_trainings_rights_add).RolesController::putSeparator($request->ces_trainings_rights_edit).RolesController::putSeparator($request->ces_trainings_rights_delete).RolesController::putSeparator($request->ces_trainings_rights_view_only),
                    'other_non_ces_accredited_trainings_rights' => RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_add).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_edit).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_delete).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_view_only),
                    'research_and_studies_rights' => RolesController::putSeparator($request->research_and_studies_rights_add).RolesController::putSeparator($request->research_and_studies_rights_edit).RolesController::putSeparator($request->research_and_studies_rights_delete).RolesController::putSeparator($request->research_and_studies_rights_view_only),
                    'scholarships_received_rights' => RolesController::putSeparator($request->scholarships_received_rights_add).RolesController::putSeparator($request->scholarships_received_rights_edit).RolesController::putSeparator($request->scholarships_received_rights_delete).RolesController::putSeparator($request->scholarships_received_rights_view_only),
                    'major_civic_and_professional_affiliations_rights' => RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_add).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_edit).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_delete).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_view_only),
                    'awards_and_citations_received_rights' => RolesController::putSeparator($request->awards_and_citations_received_rights_add).RolesController::putSeparator($request->awards_and_citations_received_rights_edit).RolesController::putSeparator($request->awards_and_citations_received_rights_delete).RolesController::putSeparator($request->awards_and_citations_received_rights_view_only),
                    'case_records_rights' => RolesController::putSeparator($request->case_records_rights_add).RolesController::putSeparator($request->case_records_rights_edit).RolesController::putSeparator($request->case_records_rights_delete).RolesController::putSeparator($request->case_records_rights_view_only),
                    'health_record_rights' => RolesController::putSeparator($request->health_record_rights_add).RolesController::putSeparator($request->health_record_rights_edit).RolesController::putSeparator($request->health_record_rights_delete).RolesController::putSeparator($request->health_record_rights_view_only),
                    'attached_pdf_files_rights' => RolesController::putSeparator($request->attached_pdf_files_rights_add).RolesController::putSeparator($request->attached_pdf_files_rights_edit).RolesController::putSeparator($request->attached_pdf_files_rights_delete).RolesController::putSeparator($request->attached_pdf_files_rights_view_only),
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

    public function updateExecutive201RoleAccess(Request $request, $id){
        
        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'executive_201_page_access' => $request->personal_data.$request->family_background_profile.$request->educational_background_attainment.$request->examinations_taken.$request->language_dialects.$request->eligibility_and_rank_tracker.$request->record_of_cespes_ratings.$request->work_experience.$request->records_of_field_of_expertise_specialization.$request->ces_trainings.$request->other_non_ces_accredited_trainings.$request->research_and_studies.$request->scholarships_received.$request->major_civic_and_professional_affiliations.$request->awards_and_citations_received.$request->case_records.$request->health_record.$request->attached_pdf_files,
                    'personal_data' => $request->personal_data,
                    'family_background_profile' => $request->family_background_profile,
                    'educational_background_attainment' => $request->educational_background_attainment,
                    'examinations_taken' => $request->examinations_taken,
                    'language_dialects' => $request->language_dialects,
                    'eligibility_and_rank_tracker' => $request->eligibility_and_rank_tracker,
                    'record_of_cespes_ratings' => $request->record_of_cespes_ratings,
                    'work_experience' => $request->work_experience,
                    'records_of_field_of_expertise_specialization' => $request->records_of_field_of_expertise_specialization,
                    'ces_trainings' => $request->ces_trainings,
                    'other_non_ces_accredited_trainings' => $request->other_non_ces_accredited_trainings,
                    'research_and_studies' => $request->research_and_studies,
                    'scholarships_received' => $request->scholarships_received,
                    'major_civic_and_professional_affiliations' => $request->major_civic_and_professional_affiliations,
                    'awards_and_citations_received' => $request->awards_and_citations_received,
                    'case_records' => $request->case_records,
                    'health_record' => $request->health_record,
                    'attached_pdf_files' => $request->attached_pdf_files,
                    'personal_data_rights' => $request->personal_data_rights_add.$request->personal_data_rights_edit.$request->personal_data_rights_delete.$request->personal_data_rights_view_only,
                    'family_background_profile_rights' => $request->family_background_profile_rights_add.$request->family_background_profile_rights_edit.$request->family_background_profile_rights_delete.$request->family_background_profile_rights_view_only,
                    'educational_background_attainment_rights' => $request->educational_background_attainment_rights_add.$request->educational_background_attainment_rights_edit.$request->educational_background_attainment_rights_delete.$request->educational_background_attainment_rights_view_only,
                    'examinations_taken_rights' => $request->examinations_taken_rights_add.$request->examinations_taken_rights_edit.$request->examinations_taken_rights_delete.$request->examinations_taken_rights_view_only,
                    'language_dialects_rights' => $request->language_dialects_rights_add.$request->language_dialects_rights_edit.$request->language_dialects_rights_delete.$request->language_dialects_rights_view_only,
                    'eligibility_and_rank_tracker_rights' => $request->eligibility_and_rank_tracker_rights_add.$request->eligibility_and_rank_tracker_rights_edit.$request->eligibility_and_rank_tracker_rights_delete.$request->eligibility_and_rank_tracker_rights_view_only,
                    'record_of_cespes_ratings_rights' => $request->record_of_cespes_ratings_rights_add.$request->record_of_cespes_ratings_rights_edit.$request->record_of_cespes_ratings_rights_delete.$request->record_of_cespes_ratings_rights_view_only,
                    'work_experience_rights' => $request->work_experience_rights_add.$request->work_experience_rights_edit.$request->work_experience_rights_delete.$request->work_experience_rights_view_only,
                    'records_of_field_of_expertise_specialization_rights' => $request->records_of_field_of_expertise_specialization_rights_add.$request->records_of_field_of_expertise_specialization_rights_edit.$request->records_of_field_of_expertise_specialization_rights_delete.$request->records_of_field_of_expertise_specialization_rights_view_only,
                    'ces_trainings_rights' => $request->ces_trainings_rights_add.$request->ces_trainings_rights_edit.$request->ces_trainings_rights_delete.$request->ces_trainings_rights_view_only,
                    'other_non_ces_accredited_trainings_rights' => $request->other_non_ces_accredited_trainings_rights_add.$request->other_non_ces_accredited_trainings_rights_edit.$request->other_non_ces_accredited_trainings_rights_delete.$request->other_non_ces_accredited_trainings_rights_view_only,
                    'research_and_studies_rights' => $request->research_and_studies_rights_add.$request->research_and_studies_rights_edit.$request->research_and_studies_rights_delete.$request->research_and_studies_rights_view_only,
                    'scholarships_received_rights' => $request->scholarships_received_rights_add.$request->scholarships_received_rights_edit.$request->scholarships_received_rights_delete.$request->scholarships_received_rights_view_only,
                    'major_civic_and_professional_affiliations_rights' => $request->major_civic_and_professional_affiliations_rights_add.$request->major_civic_and_professional_affiliations_rights_edit.$request->major_civic_and_professional_affiliations_rights_delete.$request->major_civic_and_professional_affiliations_rights_view_only,
                    'awards_and_citations_received_rights' => $request->awards_and_citations_received_rights_add.$request->awards_and_citations_received_rights_edit.$request->awards_and_citations_received_rights_delete.$request->awards_and_citations_received_rights_view_only,
                    'case_records_rights' => $request->case_records_rights_add.$request->case_records_rights_edit.$request->case_records_rights_delete.$request->case_records_rights_view_only,
                    'health_record_rights' => $request->health_record_rights_add.$request->health_record_rights_edit.$request->health_record_rights_delete.$request->health_record_rights_view_only,
                    'attached_pdf_files_rights' => $request->attached_pdf_files_rights_add.$request->attached_pdf_files_rights_edit.$request->attached_pdf_files_rights_delete.$request->attached_pdf_files_rights_view_only,
                ),
                array(
                    'executive_201_page_access' => 'required',
                    'personal_data' => 'required_with:personal_data_rights',
                    'family_background_profile' => 'required_with:family_background_profile_rights',
                    'educational_background_attainment' => 'required_with:educational_background_attainment_rights',
                    'examinations_taken' => 'required_with:examinations_taken_rights',
                    'language_dialects' => 'required_with:language_dialects_rights',
                    'eligibility_and_rank_tracker' => 'required_with:eligibility_and_rank_tracker_rights',
                    'record_of_cespes_ratings' => 'required_with:record_of_cespes_ratings_rights',
                    'work_experience' => 'required_with:work_experience_rights',
                    'records_of_field_of_expertise_specialization' => 'required_with:records_of_field_of_expertise_specialization_rights',
                    'ces_trainings' => 'required_with:ces_trainings_rights',
                    'other_non_ces_accredited_trainings' => 'required_with:other_non_ces_accredited_trainings_rights',
                    'research_and_studies' => 'required_with:research_and_studies_rights',
                    'scholarships_received' => 'required_with:scholarships_received_rights',
                    'major_civic_and_professional_affiliations' => 'required_with:major_civic_and_professional_affiliations_rights',
                    'awards_and_citations_received' => 'required_with:awards_and_citations_received_rights',
                    'case_records' => 'required_with:case_records_rights',
                    'health_record' => 'required_with:health_record_rights',
                    'attached_pdf_files' => 'required_with:attached_pdf_files_rights',
                    'personal_data_rights' => 'required_with:personal_data',
                    'family_background_profile_rights' => 'required_with:family_background_profile',
                    'educational_background_attainment_rights' => 'required_with:educational_background_attainment',
                    'examinations_taken_rights' => 'required_with:examinations_taken',
                    'language_dialects_rights' => 'required_with:language_dialects',
                    'eligibility_and_rank_tracker_rights' => 'required_with:eligibility_and_rank_tracker',
                    'record_of_cespes_ratings_rights' => 'required_with:record_of_cespes_ratings',
                    'work_experience_rights' => 'required_with:work_experience',
                    'records_of_field_of_expertise_specialization_rights' => 'required_with:records_of_field_of_expertise_specialization',
                    'ces_trainings_rights' => 'required_with:ces_trainings',
                    'other_non_ces_accredited_trainings_rights' => 'required_with:other_non_ces_accredited_trainings',
                    'research_and_studies_rights' => 'required_with:research_and_studies',
                    'scholarships_received_rights' => 'required_with:scholarships_received',
                    'major_civic_and_professional_affiliations_rights' => 'required_with:major_civic_and_professional_affiliations',
                    'awards_and_citations_received_rights' => 'required_with:awards_and_citations_received',
                    'case_records_rights' => 'required_with:case_records',
                    'health_record_rights' => 'required_with:health_record',
                    'attached_pdf_files_rights' => 'required_with:attached_pdf_files',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                Executive201RoleAccess::where('id','=',$id)->update(

                    array(
                        'executive_201_page_access' => RolesController::putSeparator($request->personal_data).RolesController::putSeparator($request->family_background_profile).RolesController::putSeparator($request->educational_background_attainment).RolesController::putSeparator($request->examinations_taken).RolesController::putSeparator($request->language_dialects).RolesController::putSeparator($request->eligibility_and_rank_tracker).RolesController::putSeparator($request->record_of_cespes_ratings).RolesController::putSeparator($request->work_experience).RolesController::putSeparator($request->records_of_field_of_expertise_specialization).RolesController::putSeparator($request->ces_trainings).RolesController::putSeparator($request->other_non_ces_accredited_trainings).RolesController::putSeparator($request->research_and_studies).RolesController::putSeparator($request->scholarships_received).RolesController::putSeparator($request->major_civic_and_professional_affiliations).RolesController::putSeparator($request->awards_and_citations_received).RolesController::putSeparator($request->case_records).RolesController::putSeparator($request->health_record).RolesController::putSeparator($request->attached_pdf_files),
                        'personal_data_rights' => RolesController::putSeparator($request->personal_data_rights_add).RolesController::putSeparator($request->personal_data_rights_edit).RolesController::putSeparator($request->personal_data_rights_delete).RolesController::putSeparator($request->personal_data_rights_view_only),
                        'family_background_profile_rights' => RolesController::putSeparator($request->family_background_profile_rights_add).RolesController::putSeparator($request->family_background_profile_rights_edit).RolesController::putSeparator($request->family_background_profile_rights_delete).RolesController::putSeparator($request->family_background_profile_rights_view_only),
                        'educational_background_attainment_rights' => RolesController::putSeparator($request->educational_background_attainment_rights_add).RolesController::putSeparator($request->educational_background_attainment_rights_edit).RolesController::putSeparator($request->educational_background_attainment_rights_delete).RolesController::putSeparator($request->educational_background_attainment_rights_view_only),
                        'examinations_taken_rights' => RolesController::putSeparator($request->examinations_taken_rights_add).RolesController::putSeparator($request->examinations_taken_rights_edit).RolesController::putSeparator($request->examinations_taken_rights_delete).RolesController::putSeparator($request->examinations_taken_rights_view_only),
                        'language_dialects_rights' => RolesController::putSeparator($request->language_dialects_rights_add).RolesController::putSeparator($request->language_dialects_rights_edit).RolesController::putSeparator($request->language_dialects_rights_delete).RolesController::putSeparator($request->language_dialects_rights_view_only),
                        'eligibility_and_rank_tracker_rights' => RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_add).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_edit).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_delete).RolesController::putSeparator($request->eligibility_and_rank_tracker_rights_view_only),
                        'record_of_cespes_ratings_rights' => RolesController::putSeparator($request->record_of_cespes_ratings_rights_add).RolesController::putSeparator($request->record_of_cespes_ratings_rights_edit).RolesController::putSeparator($request->record_of_cespes_ratings_rights_delete).RolesController::putSeparator($request->record_of_cespes_ratings_rights_view_only),
                        'work_experience_rights' => RolesController::putSeparator($request->work_experience_rights_add).RolesController::putSeparator($request->work_experience_rights_edit).RolesController::putSeparator($request->work_experience_rights_delete).RolesController::putSeparator($request->work_experience_rights_view_only),
                        'records_of_field_of_expertise_specialization_rights' => RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_add).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_edit).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_delete).RolesController::putSeparator($request->records_of_field_of_expertise_specialization_rights_view_only),
                        'ces_trainings_rights' => RolesController::putSeparator($request->ces_trainings_rights_add).RolesController::putSeparator($request->ces_trainings_rights_edit).RolesController::putSeparator($request->ces_trainings_rights_delete).RolesController::putSeparator($request->ces_trainings_rights_view_only),
                        'other_non_ces_accredited_trainings_rights' => RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_add).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_edit).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_delete).RolesController::putSeparator($request->other_non_ces_accredited_trainings_rights_view_only),
                        'research_and_studies_rights' => RolesController::putSeparator($request->research_and_studies_rights_add).RolesController::putSeparator($request->research_and_studies_rights_edit).RolesController::putSeparator($request->research_and_studies_rights_delete).RolesController::putSeparator($request->research_and_studies_rights_view_only),
                        'scholarships_received_rights' => RolesController::putSeparator($request->scholarships_received_rights_add).RolesController::putSeparator($request->scholarships_received_rights_edit).RolesController::putSeparator($request->scholarships_received_rights_delete).RolesController::putSeparator($request->scholarships_received_rights_view_only),
                        'major_civic_and_professional_affiliations_rights' => RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_add).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_edit).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_delete).RolesController::putSeparator($request->major_civic_and_professional_affiliations_rights_view_only),
                        'awards_and_citations_received_rights' => RolesController::putSeparator($request->awards_and_citations_received_rights_add).RolesController::putSeparator($request->awards_and_citations_received_rights_edit).RolesController::putSeparator($request->awards_and_citations_received_rights_delete).RolesController::putSeparator($request->awards_and_citations_received_rights_view_only),
                        'case_records_rights' => RolesController::putSeparator($request->case_records_rights_add).RolesController::putSeparator($request->case_records_rights_edit).RolesController::putSeparator($request->case_records_rights_delete).RolesController::putSeparator($request->case_records_rights_view_only),
                        'health_record_rights' => RolesController::putSeparator($request->health_record_rights_add).RolesController::putSeparator($request->health_record_rights_edit).RolesController::putSeparator($request->health_record_rights_delete).RolesController::putSeparator($request->health_record_rights_view_only),
                        'attached_pdf_files_rights' => RolesController::putSeparator($request->attached_pdf_files_rights_add).RolesController::putSeparator($request->attached_pdf_files_rights_edit).RolesController::putSeparator($request->attached_pdf_files_rights_delete).RolesController::putSeparator($request->attached_pdf_files_rights_view_only),
                        'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    )
                );

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteExecutive201RoleAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            Executive201RoleAccess::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function getExecutive201RoleAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $executive_201_role_access = Executive201RoleAccess::where('id','=',$id)->get();
            
            return $executive_201_role_access;
        }
        else{

            return 'Restricted';
        }
    }

    public function addCesWebAppGeneralPageAccess(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'role_name_ces_web_app_general_page' => $request->role_name_ces_web_app_general_page,
                    'ces_web_app_general_page_access' => $request->general_page_dashboard.$request->general_page_201_profiling.$request->general_page_plantilla.$request->general_page_reports.$request->general_page_rights_management.$request->general_page_system_utility.$request->general_page_competency.$request->general_page_database_migration,
                ),
                array(
                    'role_name_ces_web_app_general_page' => 'required|unique:ces_web_app_general_page_accesses',
                    'ces_web_app_general_page_access' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesWebAppGeneralPageAccess::create([
                    'role_name_ces_web_app_general_page' => $request->role_name_ces_web_app_general_page,
                    'ces_web_app_general_page_access' => RolesController::putSeparator($request->general_page_dashboard).RolesController::putSeparator($request->general_page_201_profiling).RolesController::putSeparator($request->general_page_plantilla).RolesController::putSeparator($request->general_page_reports).RolesController::putSeparator($request->general_page_rights_management).RolesController::putSeparator($request->general_page_system_utility).RolesController::putSeparator($request->general_page_competency).RolesController::putSeparator($request->general_page_database_migration),
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

    public function updateCesWebAppGeneralPageAccess(Request $request, $id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'ces_web_app_general_page_access' => $request->general_page_dashboard.$request->general_page_201_profiling.$request->general_page_plantilla.$request->general_page_reports.$request->general_page_rights_management.$request->general_page_system_utility.$request->general_page_competency.$request->general_page_database_migration,
                ),
                array(
                    'ces_web_app_general_page_access' => 'required',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                CesWebAppGeneralPageAccess::where('id','=',$id)->update([
                    'ces_web_app_general_page_access' => RolesController::putSeparator($request->general_page_dashboard).RolesController::putSeparator($request->general_page_201_profiling).RolesController::putSeparator($request->general_page_plantilla).RolesController::putSeparator($request->general_page_reports).RolesController::putSeparator($request->general_page_rights_management).RolesController::putSeparator($request->general_page_system_utility).RolesController::putSeparator($request->general_page_competency).RolesController::putSeparator($request->general_page_database_migration),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteCesWebAppGeneralPageAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            CesWebAppGeneralPageAccess::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function getCesWebAppGeneralPageAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $ces_web_app_general_page_access = CesWebAppGeneralPageAccess::where('id','=',$id)->get();
            
            return $ces_web_app_general_page_access;
        }
        else{

            return 'Restricted';
        }
    }

    public function addPlantillaManangementAccess(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'role_name_plantilla_manangement' => $request->role_name_plantilla_manangement,
                    'plantilla_manangement_page_access' => $request->plantilla_management_main_screen.$request->sector_manager.$request->department_agency_manager.$request->agency_location_manager.$request->office_manager.$request->plantilla_position_manager.$request->plantilla_position_classification_manager.$request->appointee_occupant_manager.$request->plantilla_appointee_occupant_browser,
                    'plantilla_management_main_screen' => $request->plantilla_management_main_screen,
                    'sector_manager' => $request->sector_manager,
                    'department_agency_manager' => $request->department_agency_manager,
                    'agency_location_manager' => $request->agency_location_manager,
                    'office_manager' => $request->office_manager,
                    'plantilla_position_manager' => $request->plantilla_position_manager,
                    'plantilla_position_classification_manager' => $request->plantilla_position_classification_manager,
                    'appointee_occupant_manager' => $request->appointee_occupant_manager,
                    'plantilla_appointee_occupant_browser' => $request->plantilla_appointee_occupant_browser,
                    'plantilla_management_main_screen_rights' => $request->plantilla_management_main_screen_rights_add.$request->plantilla_management_main_screen_rights_edit.$request->plantilla_management_main_screen_rights_delete.$request->plantilla_management_main_screen_rights_view_only,
                    'sector_manager_rights' => $request->sector_manager_rights_add.$request->sector_manager_rights_edit.$request->sector_manager_rights_delete.$request->sector_manager_rights_view_only,
                    'department_agency_manager_rights' => $request->department_agency_manager_rights_add.$request->department_agency_manager_rights_edit.$request->department_agency_manager_rights_delete.$request->department_agency_manager_rights_view_only,
                    'agency_location_manager_rights' => $request->agency_location_manager_rights_add.$request->agency_location_manager_rights_edit.$request->agency_location_manager_rights_delete.$request->agency_location_manager_rights_view_only,
                    'office_manager_rights' => $request->office_manager_rights_add.$request->office_manager_rights_edit.$request->office_manager_rights_delete.$request->office_manager_rights_view_only,
                    'plantilla_position_manager_rights' => $request->plantilla_position_manager_rights_add.$request->plantilla_position_manager_rights_edit.$request->plantilla_position_manager_rights_delete.$request->plantilla_position_manager_rights_view_only,
                    'plantilla_position_classification_manager_rights' => $request->plantilla_position_classification_manager_rights_add.$request->plantilla_position_classification_manager_rights_edit.$request->plantilla_position_classification_manager_rights_delete.$request->plantilla_position_classification_manager_rights_view_only,
                    'appointee_occupant_manager_rights' => $request->appointee_occupant_manager_rights_add.$request->appointee_occupant_manager_rights_edit.$request->appointee_occupant_manager_rights_delete.$request->appointee_occupant_manager_rights_view_only,
                    'plantilla_appointee_occupant_browser_rights' => $request->plantilla_appointee_occupant_browser_rights_add.$request->plantilla_appointee_occupant_browser_rights_edit.$request->plantilla_appointee_occupant_browser_rights_delete.$request->plantilla_appointee_occupant_browser_rights_view_only,
                ),
                array(
                    'role_name_plantilla_manangement' => 'required|unique:plantilla_manangement_accesses',
                    'plantilla_manangement_page_access' => 'required',
                    'plantilla_management_main_screen' => 'required_with:plantilla_management_main_screen_rights',
                    'sector_manager' => 'required_with:sector_manager_rights',
                    'department_agency_manager' => 'required_with:department_agency_manager_rights',
                    'agency_location_manager' => 'required_with:agency_location_manager_rights',
                    'office_manager' => 'required_with:office_manager_rights',
                    'plantilla_position_manager' => 'required_with:plantilla_position_manager_rights',
                    'plantilla_position_classification_manager' => 'required_with:plantilla_position_classification_manager_rights',
                    'appointee_occupant_manager' => 'required_with:appointee_occupant_manager_rights',
                    'plantilla_appointee_occupant_browser' => 'required_with:plantilla_appointee_occupant_browser_rights',
                    'plantilla_management_main_screen_rights' => 'required_with:plantilla_management_main_screen',
                    'sector_manager_rights' => 'required_with:sector_manager',
                    'department_agency_manager_rights' => 'required_with:department_agency_manager',
                    'agency_location_manager_rights' => 'required_with:agency_location_manager',
                    'office_manager_rights' => 'required_with:office_manager',
                    'plantilla_position_manager_rights' => 'required_with:plantilla_position_manager',
                    'plantilla_position_classification_manager_rights' => 'required_with:plantilla_position_classification_manager',
                    'appointee_occupant_manager_rights' => 'required_with:appointee_occupant_manager',
                    'plantilla_appointee_occupant_browser_rights' => 'required_with:plantilla_appointee_occupant_browser',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                PlantillaManangementAccess::create([
                    'role_name_plantilla_manangement' => $request->role_name_plantilla_manangement,
                    'plantilla_manangement_page_access' => RolesController::putSeparator($request->plantilla_management_main_screen).RolesController::putSeparator($request->sector_manager).RolesController::putSeparator($request->department_agency_manager).RolesController::putSeparator($request->agency_location_manager).RolesController::putSeparator($request->office_manager).RolesController::putSeparator($request->plantilla_position_manager).RolesController::putSeparator($request->plantilla_position_classification_manager).RolesController::putSeparator($request->appointee_occupant_manager).RolesController::putSeparator($request->plantilla_appointee_occupant_browser),
                    'plantilla_management_main_screen_rights' => RolesController::putSeparator($request->plantilla_management_main_screen_rights_add).RolesController::putSeparator($request->plantilla_management_main_screen_rights_edit).RolesController::putSeparator($request->plantilla_management_main_screen_rights_delete).RolesController::putSeparator($request->plantilla_management_main_screen_rights_view_only),
                    'sector_manager_rights' => RolesController::putSeparator($request->sector_manager_rights_add).RolesController::putSeparator($request->sector_manager_rights_edit).RolesController::putSeparator($request->sector_manager_rights_delete).RolesController::putSeparator($request->sector_manager_rights_view_only),
                    'department_agency_manager_rights' => RolesController::putSeparator($request->department_agency_manager_rights_add).RolesController::putSeparator($request->department_agency_manager_rights_edit).RolesController::putSeparator($request->department_agency_manager_rights_delete).RolesController::putSeparator($request->department_agency_manager_rights_view_only),
                    'agency_location_manager_rights' => RolesController::putSeparator($request->agency_location_manager_rights_add).RolesController::putSeparator($request->agency_location_manager_rights_edit).RolesController::putSeparator($request->agency_location_manager_rights_delete).RolesController::putSeparator($request->agency_location_manager_rights_view_only),
                    'office_manager_rights' => RolesController::putSeparator($request->office_manager_rights_add).RolesController::putSeparator($request->office_manager_rights_edit).RolesController::putSeparator($request->office_manager_rights_delete).RolesController::putSeparator($request->office_manager_rights_view_only),
                    'plantilla_position_manager_rights' => RolesController::putSeparator($request->plantilla_position_manager_rights_add).RolesController::putSeparator($request->plantilla_position_manager_rights_edit).RolesController::putSeparator($request->plantilla_position_manager_rights_delete).RolesController::putSeparator($request->plantilla_position_manager_rights_view_only),
                    'plantilla_position_classification_manager_rights' => RolesController::putSeparator($request->plantilla_position_classification_manager_rights_add).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_edit).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_delete).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_view_only),
                    'appointee_occupant_manager_rights' => RolesController::putSeparator($request->appointee_occupant_manager_rights_add).RolesController::putSeparator($request->appointee_occupant_manager_rights_edit).RolesController::putSeparator($request->appointee_occupant_manager_rights_delete).RolesController::putSeparator($request->appointee_occupant_manager_rights_view_only),
                    'plantilla_appointee_occupant_browser_rights' => RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_add).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_edit).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_delete).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_view_only),
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

    public function updatePlantillaManangementAccess(Request $request, $id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'plantilla_manangement_page_access' => $request->plantilla_management_main_screen.$request->sector_manager.$request->department_agency_manager.$request->agency_location_manager.$request->office_manager.$request->plantilla_position_manager.$request->plantilla_position_classification_manager.$request->appointee_occupant_manager.$request->plantilla_appointee_occupant_browser,
                    'plantilla_management_main_screen' => $request->plantilla_management_main_screen,
                    'sector_manager' => $request->sector_manager,
                    'department_agency_manager' => $request->department_agency_manager,
                    'agency_location_manager' => $request->agency_location_manager,
                    'office_manager' => $request->office_manager,
                    'plantilla_position_manager' => $request->plantilla_position_manager,
                    'plantilla_position_classification_manager' => $request->plantilla_position_classification_manager,
                    'appointee_occupant_manager' => $request->appointee_occupant_manager,
                    'plantilla_appointee_occupant_browser' => $request->plantilla_appointee_occupant_browser,
                    'plantilla_management_main_screen_rights' => $request->plantilla_management_main_screen_rights_add.$request->plantilla_management_main_screen_rights_edit.$request->plantilla_management_main_screen_rights_delete.$request->plantilla_management_main_screen_rights_view_only,
                    'sector_manager_rights' => $request->sector_manager_rights_add.$request->sector_manager_rights_edit.$request->sector_manager_rights_delete.$request->sector_manager_rights_view_only,
                    'department_agency_manager_rights' => $request->department_agency_manager_rights_add.$request->department_agency_manager_rights_edit.$request->department_agency_manager_rights_delete.$request->department_agency_manager_rights_view_only,
                    'agency_location_manager_rights' => $request->agency_location_manager_rights_add.$request->agency_location_manager_rights_edit.$request->agency_location_manager_rights_delete.$request->agency_location_manager_rights_view_only,
                    'office_manager_rights' => $request->office_manager_rights_add.$request->office_manager_rights_edit.$request->office_manager_rights_delete.$request->office_manager_rights_view_only,
                    'plantilla_position_manager_rights' => $request->plantilla_position_manager_rights_add.$request->plantilla_position_manager_rights_edit.$request->plantilla_position_manager_rights_delete.$request->plantilla_position_manager_rights_view_only,
                    'plantilla_position_classification_manager_rights' => $request->plantilla_position_classification_manager_rights_add.$request->plantilla_position_classification_manager_rights_edit.$request->plantilla_position_classification_manager_rights_delete.$request->plantilla_position_classification_manager_rights_view_only,
                    'appointee_occupant_manager_rights' => $request->appointee_occupant_manager_rights_add.$request->appointee_occupant_manager_rights_edit.$request->appointee_occupant_manager_rights_delete.$request->appointee_occupant_manager_rights_view_only,
                    'plantilla_appointee_occupant_browser_rights' => $request->plantilla_appointee_occupant_browser_rights_add.$request->plantilla_appointee_occupant_browser_rights_edit.$request->plantilla_appointee_occupant_browser_rights_delete.$request->plantilla_appointee_occupant_browser_rights_view_only,
                ),
                array(
                    'plantilla_manangement_page_access' => 'required',
                    'plantilla_management_main_screen' => 'required_with:plantilla_management_main_screen_rights',
                    'sector_manager' => 'required_with:sector_manager_rights',
                    'department_agency_manager' => 'required_with:department_agency_manager_rights',
                    'agency_location_manager' => 'required_with:agency_location_manager_rights',
                    'office_manager' => 'required_with:office_manager_rights',
                    'plantilla_position_manager' => 'required_with:plantilla_position_manager_rights',
                    'plantilla_position_classification_manager' => 'required_with:plantilla_position_classification_manager_rights',
                    'appointee_occupant_manager' => 'required_with:appointee_occupant_manager_rights',
                    'plantilla_appointee_occupant_browser' => 'required_with:plantilla_appointee_occupant_browser_rights',
                    'plantilla_management_main_screen_rights' => 'required_with:plantilla_management_main_screen',
                    'sector_manager_rights' => 'required_with:sector_manager',
                    'department_agency_manager_rights' => 'required_with:department_agency_manager',
                    'agency_location_manager_rights' => 'required_with:agency_location_manager',
                    'office_manager_rights' => 'required_with:office_manager',
                    'plantilla_position_manager_rights' => 'required_with:plantilla_position_manager',
                    'plantilla_position_classification_manager_rights' => 'required_with:plantilla_position_classification_manager',
                    'appointee_occupant_manager_rights' => 'required_with:appointee_occupant_manager',
                    'plantilla_appointee_occupant_browser_rights' => 'required_with:plantilla_appointee_occupant_browser',
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                PlantillaManangementAccess::where('id','=',$id)->update([
                    'plantilla_manangement_page_access' => RolesController::putSeparator($request->plantilla_management_main_screen).RolesController::putSeparator($request->sector_manager).RolesController::putSeparator($request->department_agency_manager).RolesController::putSeparator($request->agency_location_manager).RolesController::putSeparator($request->office_manager).RolesController::putSeparator($request->plantilla_position_manager).RolesController::putSeparator($request->plantilla_position_classification_manager).RolesController::putSeparator($request->appointee_occupant_manager).RolesController::putSeparator($request->plantilla_appointee_occupant_browser),
                    'plantilla_management_main_screen_rights' => RolesController::putSeparator($request->plantilla_management_main_screen_rights_add).RolesController::putSeparator($request->plantilla_management_main_screen_rights_edit).RolesController::putSeparator($request->plantilla_management_main_screen_rights_delete).RolesController::putSeparator($request->plantilla_management_main_screen_rights_view_only),
                    'sector_manager_rights' => RolesController::putSeparator($request->sector_manager_rights_add).RolesController::putSeparator($request->sector_manager_rights_edit).RolesController::putSeparator($request->sector_manager_rights_delete).RolesController::putSeparator($request->sector_manager_rights_view_only),
                    'department_agency_manager_rights' => RolesController::putSeparator($request->department_agency_manager_rights_add).RolesController::putSeparator($request->department_agency_manager_rights_edit).RolesController::putSeparator($request->department_agency_manager_rights_delete).RolesController::putSeparator($request->department_agency_manager_rights_view_only),
                    'agency_location_manager_rights' => RolesController::putSeparator($request->agency_location_manager_rights_add).RolesController::putSeparator($request->agency_location_manager_rights_edit).RolesController::putSeparator($request->agency_location_manager_rights_delete).RolesController::putSeparator($request->agency_location_manager_rights_view_only),
                    'office_manager_rights' => RolesController::putSeparator($request->office_manager_rights_add).RolesController::putSeparator($request->office_manager_rights_edit).RolesController::putSeparator($request->office_manager_rights_delete).RolesController::putSeparator($request->office_manager_rights_view_only),
                    'plantilla_position_manager_rights' => RolesController::putSeparator($request->plantilla_position_manager_rights_add).RolesController::putSeparator($request->plantilla_position_manager_rights_edit).RolesController::putSeparator($request->plantilla_position_manager_rights_delete).RolesController::putSeparator($request->plantilla_position_manager_rights_view_only),
                    'plantilla_position_classification_manager_rights' => RolesController::putSeparator($request->plantilla_position_classification_manager_rights_add).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_edit).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_delete).RolesController::putSeparator($request->plantilla_position_classification_manager_rights_view_only),
                    'appointee_occupant_manager_rights' => RolesController::putSeparator($request->appointee_occupant_manager_rights_add).RolesController::putSeparator($request->appointee_occupant_manager_rights_edit).RolesController::putSeparator($request->appointee_occupant_manager_rights_delete).RolesController::putSeparator($request->appointee_occupant_manager_rights_view_only),
                    'plantilla_appointee_occupant_browser_rights' => RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_add).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_edit).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_delete).RolesController::putSeparator($request->plantilla_appointee_occupant_browser_rights_view_only),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function deletePlantillaManangementAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            PlantillaManangementAccess::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function getPlantillaManangementAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $plantilla_manangement_access = PlantillaManangementAccess::where('id','=',$id)->get();
            
            return $plantilla_manangement_access;
        }
        else{

            return 'Restricted';
        }
    }

    public function addReportGenerationAccess(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'role_name_report_generation' => $request->role_name_report_generation,
                    'rep_gen_executive_201_profile_access' => $request->list_of_active_and_or_retired_cesos_ces_eligibles_and_csees.$request->list_of_deceased_cesos_ces_eligibles_and_csees.$request->list_of_active_ces_w_or_wo_active_pending_cases.$request->list_of_active_ces_by_appointing_authority.$request->list_of_active_ces_candidate_for_retirement.$request->age_demographics.$request->active_vs_retired_demographics.$request->statistic_summary_per_presidential_appointments.$request->list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree.$request->list_of_officials_per_birth_month.$request->personal_data_sheet_based_on_201_profile_information,
                    'rep_gen_competency_training_management_sub_module_access' => $request->masterlist_per_training_conducted.$request->masterlist_of_training_venues.$request->list_of_training_venues_by_city.$request->masterlist_of_training_providers.$request->masterlist_of_resource_speaker_persons.$request->list_of_resource_speakers_persons_by_expertise.$request->list_of_resource_speakers_persons_by_inclusive_date,
                    'rep_gen_eligibility_and_rank_tracking_access' => $request->masterlist_of_officials_undergoing_the_4_stage_eligibility.$request->masterlist_of_examinees_per_examination_date_location.$request->masterlist_of_examinees_per_defined_rating_pass_or_failed.$request->masterlist_of_ces_we_retakers.$request->masterlist_of_ac_takers_per_ac_date.$request->masterlist_of_ac_passers_per_ac_date.$request->masterlist_of_ac_retakers.$request->masterlist_of_validated_officials_per_validation_date_or_type.$request->masterlist_of_officials_who_has_taken_board_panel_interview,
                    'rep_gen_plantilla_management_reports_access' => $request->plantilla_statistics_all.$request->plantilla_statistics_ces_only.$request->plantilla_statistics_non_ces_only.$request->plantilla_statistics_by_gender_all_ces_or_non_ces.$request->plantilla_statistics_summary_including_gender_by_agency.$request->plantilla_statistics_per_department_attached_agency_ces_position.$request->occupancy_report_all.$request->occupancy_report_ces_only.$request->occupancy_report_non_ces_only.$request->plantilla_position_list_per_agency_based_on_classification.$request->ces_bluebook.$request->mailing_list_per_agency.$request->list_of_officials_by_department.$request->list_of_officials_by_appointment_or_assumption_dates,
                ),
                array(
                    'role_name_report_generation' => 'required|unique:report_generation_accesses',
                    'rep_gen_executive_201_profile_access' => '',
                    'rep_gen_competency_training_management_sub_module_access' => '',
                    'rep_gen_eligibility_and_rank_tracking_access' => '',
                    'rep_gen_plantilla_management_reports_access' => '',

                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ReportGenerationAccess::create([
                    'role_name_report_generation' => $request->role_name_report_generation,
                    'rep_gen_executive_201_profile_access' => RolesController::putVerticalLineSeparator($request->list_of_active_and_or_retired_cesos_ces_eligibles_and_csees).RolesController::putVerticalLineSeparator($request->list_of_deceased_cesos_ces_eligibles_and_csees).RolesController::putVerticalLineSeparator($request->list_of_active_ces_w_or_wo_active_pending_cases).RolesController::putVerticalLineSeparator($request->list_of_active_ces_by_appointing_authority).RolesController::putVerticalLineSeparator($request->list_of_active_ces_candidate_for_retirement).RolesController::putVerticalLineSeparator($request->age_demographics).RolesController::putVerticalLineSeparator($request->active_vs_retired_demographics).RolesController::putVerticalLineSeparator($request->statistic_summary_per_presidential_appointments).RolesController::putVerticalLineSeparator($request->list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree).RolesController::putVerticalLineSeparator($request->list_of_officials_per_birth_month).RolesController::putVerticalLineSeparator($request->personal_data_sheet_based_on_201_profile_information),
                    'rep_gen_competency_training_management_sub_module_access' => RolesController::putVerticalLineSeparator($request->masterlist_per_training_conducted).RolesController::putVerticalLineSeparator($request->masterlist_of_training_venues).RolesController::putVerticalLineSeparator($request->list_of_training_venues_by_city).RolesController::putVerticalLineSeparator($request->masterlist_of_training_providers).RolesController::putVerticalLineSeparator($request->masterlist_of_resource_speaker_persons).RolesController::putVerticalLineSeparator($request->list_of_resource_speakers_persons_by_expertise).RolesController::putVerticalLineSeparator($request->list_of_resource_speakers_persons_by_inclusive_date),
                    'rep_gen_eligibility_and_rank_tracking_access' => RolesController::putVerticalLineSeparator($request->masterlist_of_officials_undergoing_the_4_stage_eligibility).RolesController::putVerticalLineSeparator($request->masterlist_of_examinees_per_examination_date_location).RolesController::putVerticalLineSeparator($request->masterlist_of_examinees_per_defined_rating_pass_or_failed).RolesController::putVerticalLineSeparator($request->masterlist_of_ces_we_retakers).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_takers_per_ac_date).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_passers_per_ac_date).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_retakers).RolesController::putVerticalLineSeparator($request->masterlist_of_validated_officials_per_validation_date_or_type).RolesController::putVerticalLineSeparator($request->masterlist_of_officials_who_has_taken_board_panel_interview),
                    'rep_gen_plantilla_management_reports_access' => RolesController::putVerticalLineSeparator($request->plantilla_statistics_all).RolesController::putVerticalLineSeparator($request->plantilla_statistics_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_statistics_non_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_statistics_by_gender_all_ces_or_non_ces).RolesController::putVerticalLineSeparator($request->plantilla_statistics_summary_including_gender_by_agency).RolesController::putVerticalLineSeparator($request->plantilla_statistics_per_department_attached_agency_ces_position).RolesController::putVerticalLineSeparator($request->occupancy_report_all).RolesController::putVerticalLineSeparator($request->occupancy_report_ces_only).RolesController::putVerticalLineSeparator($request->occupancy_report_non_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_position_list_per_agency_based_on_classification).RolesController::putVerticalLineSeparator($request->ces_bluebook).RolesController::putVerticalLineSeparator($request->mailing_list_per_agency).RolesController::putVerticalLineSeparator($request->list_of_officials_by_department).RolesController::putVerticalLineSeparator($request->list_of_officials_by_appointment_or_assumption_dates),
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

    public function updateReportGenerationAccess(Request $request, $id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'rep_gen_executive_201_profile_access' => $request->list_of_active_and_or_retired_cesos_ces_eligibles_and_csees.$request->list_of_deceased_cesos_ces_eligibles_and_csees.$request->list_of_active_ces_w_or_wo_active_pending_cases.$request->list_of_active_ces_by_appointing_authority.$request->list_of_active_ces_candidate_for_retirement.$request->age_demographics.$request->active_vs_retired_demographics.$request->statistic_summary_per_presidential_appointments.$request->list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree.$request->list_of_officials_per_birth_month.$request->personal_data_sheet_based_on_201_profile_information,
                    'rep_gen_competency_training_management_sub_module_access' => $request->masterlist_per_training_conducted.$request->masterlist_of_training_venues.$request->list_of_training_venues_by_city.$request->masterlist_of_training_providers.$request->masterlist_of_resource_speaker_persons.$request->list_of_resource_speakers_persons_by_expertise.$request->list_of_resource_speakers_persons_by_inclusive_date,
                    'rep_gen_eligibility_and_rank_tracking_access' => $request->masterlist_of_officials_undergoing_the_4_stage_eligibility.$request->masterlist_of_examinees_per_examination_date_location.$request->masterlist_of_examinees_per_defined_rating_pass_or_failed.$request->masterlist_of_ces_we_retakers.$request->masterlist_of_ac_takers_per_ac_date.$request->masterlist_of_ac_passers_per_ac_date.$request->masterlist_of_ac_retakers.$request->masterlist_of_validated_officials_per_validation_date_or_type.$request->masterlist_of_officials_who_has_taken_board_panel_interview,
                    'rep_gen_plantilla_management_reports_access' => $request->plantilla_statistics_all.$request->plantilla_statistics_ces_only.$request->plantilla_statistics_non_ces_only.$request->plantilla_statistics_by_gender_all_ces_or_non_ces.$request->plantilla_statistics_summary_including_gender_by_agency.$request->plantilla_statistics_per_department_attached_agency_ces_position.$request->occupancy_report_all.$request->occupancy_report_ces_only.$request->occupancy_report_non_ces_only.$request->plantilla_position_list_per_agency_based_on_classification.$request->ces_bluebook.$request->mailing_list_per_agency.$request->list_of_officials_by_department.$request->list_of_officials_by_appointment_or_assumption_dates,
                ),
                array(
                    'rep_gen_executive_201_profile_access' => '',
                    'rep_gen_competency_training_management_sub_module_access' => '',
                    'rep_gen_eligibility_and_rank_tracking_access' => '',
                    'rep_gen_plantilla_management_reports_access' => '',

                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                ReportGenerationAccess::where('id','=',$id)->update([
                    'rep_gen_executive_201_profile_access' => RolesController::putVerticalLineSeparator($request->list_of_active_and_or_retired_cesos_ces_eligibles_and_csees).RolesController::putVerticalLineSeparator($request->list_of_deceased_cesos_ces_eligibles_and_csees).RolesController::putVerticalLineSeparator($request->list_of_active_ces_w_or_wo_active_pending_cases).RolesController::putVerticalLineSeparator($request->list_of_active_ces_by_appointing_authority).RolesController::putVerticalLineSeparator($request->list_of_active_ces_candidate_for_retirement).RolesController::putVerticalLineSeparator($request->age_demographics).RolesController::putVerticalLineSeparator($request->active_vs_retired_demographics).RolesController::putVerticalLineSeparator($request->statistic_summary_per_presidential_appointments).RolesController::putVerticalLineSeparator($request->list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree).RolesController::putVerticalLineSeparator($request->list_of_officials_per_birth_month).RolesController::putVerticalLineSeparator($request->personal_data_sheet_based_on_201_profile_information),
                    'rep_gen_competency_training_management_sub_module_access' => RolesController::putVerticalLineSeparator($request->masterlist_per_training_conducted).RolesController::putVerticalLineSeparator($request->masterlist_of_training_venues).RolesController::putVerticalLineSeparator($request->list_of_training_venues_by_city).RolesController::putVerticalLineSeparator($request->masterlist_of_training_providers).RolesController::putVerticalLineSeparator($request->masterlist_of_resource_speaker_persons).RolesController::putVerticalLineSeparator($request->list_of_resource_speakers_persons_by_expertise).RolesController::putVerticalLineSeparator($request->list_of_resource_speakers_persons_by_inclusive_date),
                    'rep_gen_eligibility_and_rank_tracking_access' => RolesController::putVerticalLineSeparator($request->masterlist_of_officials_undergoing_the_4_stage_eligibility).RolesController::putVerticalLineSeparator($request->masterlist_of_examinees_per_examination_date_location).RolesController::putVerticalLineSeparator($request->masterlist_of_examinees_per_defined_rating_pass_or_failed).RolesController::putVerticalLineSeparator($request->masterlist_of_ces_we_retakers).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_takers_per_ac_date).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_passers_per_ac_date).RolesController::putVerticalLineSeparator($request->masterlist_of_ac_retakers).RolesController::putVerticalLineSeparator($request->masterlist_of_validated_officials_per_validation_date_or_type).RolesController::putVerticalLineSeparator($request->masterlist_of_officials_who_has_taken_board_panel_interview),
                    'rep_gen_plantilla_management_reports_access' => RolesController::putVerticalLineSeparator($request->plantilla_statistics_all).RolesController::putVerticalLineSeparator($request->plantilla_statistics_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_statistics_non_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_statistics_by_gender_all_ces_or_non_ces).RolesController::putVerticalLineSeparator($request->plantilla_statistics_summary_including_gender_by_agency).RolesController::putVerticalLineSeparator($request->plantilla_statistics_per_department_attached_agency_ces_position).RolesController::putVerticalLineSeparator($request->occupancy_report_all).RolesController::putVerticalLineSeparator($request->occupancy_report_ces_only).RolesController::putVerticalLineSeparator($request->occupancy_report_non_ces_only).RolesController::putVerticalLineSeparator($request->plantilla_position_list_per_agency_based_on_classification).RolesController::putVerticalLineSeparator($request->ces_bluebook).RolesController::putVerticalLineSeparator($request->mailing_list_per_agency).RolesController::putVerticalLineSeparator($request->list_of_officials_by_department).RolesController::putVerticalLineSeparator($request->list_of_officials_by_appointment_or_assumption_dates),
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteReportGenerationAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            ReportGenerationAccess::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }
    }

    public function getReportGenerationAccess($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $report_generation_access = ReportGenerationAccess::where('id','=',$id)->get();
            
            return $report_generation_access;
        }
        else{

            return 'Restricted';
        }
    }
}
