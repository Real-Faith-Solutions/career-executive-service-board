@extends('layout')

@section('content')

<style>
    .nav-pills .nav-link {
        border: 1px solid #111;
        margin: 4px;
    }
</style>
<div class="container-fluid">
    <!-- Main content -->
    <section class="content">
        
        @if (str_contains(Request::url(),'rights-management/edit-executive-201-access-roles'))

        <script>setPageTitle('Edit Executive 201 Access');</script>
        @else

        <script>setPageTitle('Role Access');</script>
        @endif

        <div class="container-fluid border border-primary py-3 pt-3">
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="executive_201_tab" data-bs-toggle="tab" href="#executive_201" role="tab" aria-controls="executive_201" aria-selected="true">Executive 201</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="plantilla_manangement-tab" data-bs-toggle="tab" href="#plantilla_manangement" role="tab" aria-controls="plantilla_manangement" aria-selected="false">Plantilla Manangement</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="report_generation-tab" data-bs-toggle="tab" href="#report_generation" role="tab" aria-controls="report_generation" aria-selected="false">Report Generation</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="ces_web_app_general_page-tab" data-bs-toggle="tab" href="#ces_web_app_general_page" role="tab" aria-controls="ces_web_app_general_page" aria-selected="false">CES Web App General Page</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border border-primary">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Executive 201 -->
                        <div class="tab-pane fade show active" id="executive_201" role="tabpanel" aria-labelledby="executive_201_tab">
                           <form class="user" id="executive_201_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/executive-201-access/add`, `executive_201_form`, `Add`, `updateExecutive201RoleAccessTable`, `resetExecutive201RoleAccessForm`, `executive_201_form_submit`, `None`, `None`)">
                                @csrf

                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">ROLE NAME</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="input-group col-md-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Role Name</span>
                                        </div>
                                        <select class="form-control" id="role_name" name="role_name" required>
                                            <option value="">Please Select</option>
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Power User">Power User</option>
                                            <option value="Rank Officer">Rank Officer</option>
                                            <option value="CESB Operator">CESB Operator</option>
                                            <option value="Training Officer">Training Officer</option>
                                            <option value="CESPES Operator">CESPES Operator</option>
                                            <option value="Agency HR Operator">Agency HR Operator</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">EXECUTIVE 201 ACCESS</h4>
                                </div>
                                <div class="container-fuild m-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="personal_data" value="Personal Data">
                                            <label class="form-check-label">Personal Data</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="personal_data_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="personal_data_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="personal_data_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="personal_data_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="family_background_profile" value="Family Background Profile">
                                            <label class="form-check-label">Family Background Profile</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="family_background_profile_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="family_background_profile_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="family_background_profile_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="family_background_profile_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="educational_background_attainment" value="Educational Background or Attainment">
                                            <label class="form-check-label">Educational Background or Attainment</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="educational_background_attainment_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="educational_background_attainment_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="educational_background_attainment_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="educational_background_attainment_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="examinations_taken" value="Examinations Taken">
                                            <label class="form-check-label">Examinations Taken</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="examinations_taken_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="examinations_taken_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="examinations_taken_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="examinations_taken_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="language_dialects" value="Language Dialects">
                                            <label class="form-check-label">Language Dialects</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="language_dialects_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="language_dialects_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="language_dialects_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="language_dialects_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="eligibility_and_rank_tracker" value="Eligibility and Rank Tracker">
                                            <label class="form-check-label">Eligibility and Rank Tracker</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="eligibility_and_rank_tracker_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="eligibility_and_rank_tracker_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="eligibility_and_rank_tracker_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="eligibility_and_rank_tracker_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="record_of_cespes_ratings" value="Record of CESPES Ratings">
                                            <label class="form-check-label">Record of CESPES Ratings</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="record_of_cespes_ratings_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="record_of_cespes_ratings_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="record_of_cespes_ratings_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="record_of_cespes_ratings_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="work_experience" value="Work Experience">
                                            <label class="form-check-label">Work Experience</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="work_experience_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="work_experience_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="work_experience_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="work_experience_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="records_of_field_of_expertise_specialization" value="Records of Field of Expertise or Specialization">
                                            <label class="form-check-label">Records of Field of Expertise or Specialization</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="records_of_field_of_expertise_specialization_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="records_of_field_of_expertise_specialization_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="records_of_field_of_expertise_specialization_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="records_of_field_of_expertise_specialization_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="ces_trainings" value="CES Trainings">
                                            <label class="form-check-label">CES Trainings</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="ces_trainings_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="ces_trainings_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="ces_trainings_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="ces_trainings_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="other_non_ces_accredited_trainings" value="Other Non-CES Accredited Trainings">
                                            <label class="form-check-label">Other Non-CES Accredited Trainings</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="other_non_ces_accredited_trainings_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="other_non_ces_accredited_trainings_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="other_non_ces_accredited_trainings_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="other_non_ces_accredited_trainings_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="research_and_studies" value="Research and Studies">
                                            <label class="form-check-label">Research and Studies</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="research_and_studies_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="research_and_studies_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="research_and_studies_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="research_and_studies_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="scholarships_received" value="Scholarships Received">
                                            <label class="form-check-label">Scholarships Received</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="scholarships_received_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="scholarships_received_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="scholarships_received_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="scholarships_received_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="major_civic_and_professional_affiliations" value="Major Civic and Professional Affiliations">
                                            <label class="form-check-label">Major Civic and Professional Affiliations</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="major_civic_and_professional_affiliations_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="major_civic_and_professional_affiliations_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="major_civic_and_professional_affiliations_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="major_civic_and_professional_affiliations_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="awards_and_citations_received" value="Awards and Citations Received">
                                            <label class="form-check-label">Awards and Citations Received</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="awards_and_citations_received_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="awards_and_citations_received_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="awards_and_citations_received_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="awards_and_citations_received_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="case_records" value="Case Records">
                                            <label class="form-check-label">Case Records</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="case_records_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="case_records_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="case_records_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="case_records_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="health_record" value="Health Record">
                                            <label class="form-check-label">Health Record</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="health_record_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="health_record_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="health_record_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="health_record_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="attached_pdf_files" value="Attached PDF Files">
                                            <label class="form-check-label">Attached PDF Files</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="attached_pdf_files_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="attached_pdf_files_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="attached_pdf_files_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="attached_pdf_files_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container-fuild m-3">
                                    <div class="row ml-2 mt-3 mb-4">
                                        <div class="p-1">
                                            <input type="submit" id="executive_201_form_submit" class="btn btn-primary" value="Add Record">
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-white bg-secondary bg-gardient">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Role Name</th>
                                                <th scope="col">Executive 201 Page Access</th>
                                                <th scope="col">Personal Data Rights</th>
                                                <th scope="col">Family Background Profile Rights</th>
                                                <th scope="col">Educational Background or Attainment Rights</th>
                                                <th scope="col">Examinations Taken Rights</th>
                                                <th scope="col">Language Dialects Rights</th>
                                                <th scope="col">Eligibility and Rank Tracker Rights</th>
                                                <th scope="col">Record of CESPES Ratings Rights</th>
                                                <th scope="col">Work Experience Rights</th>
                                                <th scope="col">Records of Field of Expertise or Specialization Rights</th>
                                                <th scope="col">CES Trainings Rights</th>
                                                <th scope="col">Other Non-CES Accredited Trainings Rights</th>
                                                <th scope="col">Research and Studies Rights</th>
                                                <th scope="col">Scholarships Received Rights</th>
                                                <th scope="col">Major Civic and Professional Affiliations Rights</th>
                                                <th scope="col">Awards and Citations Received Rights</th>
                                                <th scope="col">Case Records Rights</th>
                                                <th scope="col">Health Record Rights</th>
                                                <th scope="col">Attached PDF Files Rights</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Executive201RoleAccess_tbody">
                                            @if(count($executive_201_role_access) === 0)

                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @endif
                                            @foreach($executive_201_role_access as $executive_201_role_access_item)

                                            <tr>
                                                <td>
                                                    <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetExecutive201RoleAccessForm({{ $executive_201_role_access_item->id }})">Edit</a>
                                                    <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/executive-201-access/delete/{{ $executive_201_role_access_item->id }}`, `updateExecutive201RoleAccessTable`, `resetExecutive201RoleAccessForm`, `None`, `None`)">Delete</a>
                                                </td>
                                                <td nowrap="nowrap">{{ $executive_201_role_access_item->role_name ?? '-' }}</td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->executive_201_page_access) as $executive_201_page_access_item)
                            
                                                    @if(!empty($executive_201_page_access_item))
                                                    <li>{{$executive_201_page_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->personal_data_rights) as $personal_data_rights_item)
                        
                                                    @if(!empty($personal_data_rights_item))
                                                    <li>{{$personal_data_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->family_background_profile_rights) as $family_background_profile_rights_item)
                        
                                                    @if(!empty($family_background_profile_rights_item))
                                                    <li>{{$family_background_profile_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->educational_background_attainment_rights) as $educational_background_attainment_rights_item)
                        
                                                    @if(!empty($educational_background_attainment_rights_item))
                                                    <li>{{$educational_background_attainment_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach    
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->examinations_taken_rights) as $examinations_taken_rights_item)
                        
                                                    @if(!empty($examinations_taken_rights_item))
                                                    <li>{{$examinations_taken_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->language_dialects_rights) as $language_dialects_rights_item)
                        
                                                    @if(!empty($language_dialects_rights_item))
                                                    <li>{{$language_dialects_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->eligibility_and_rank_tracker_rights) as $eligibility_and_rank_tracker_rights_item)
                        
                                                    @if(!empty($eligibility_and_rank_tracker_rights_item))
                                                    <li>{{$eligibility_and_rank_tracker_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->record_of_cespes_ratings_rights) as $record_of_cespes_ratings_rights_item)
                        
                                                    @if(!empty($record_of_cespes_ratings_rights_item))
                                                    <li>{{$record_of_cespes_ratings_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->work_experience_rights) as $work_experience_rights_item)
                        
                                                    @if(!empty($work_experience_rights_item))
                                                    <li>{{$work_experience_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->records_of_field_of_expertise_specialization_rights) as $records_of_field_of_expertise_specialization_rights_item)
                        
                                                    @if(!empty($records_of_field_of_expertise_specialization_rights_item))
                                                    <li>{{$records_of_field_of_expertise_specialization_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->ces_trainings_rights) as $ces_trainings_rights_item)
                        
                                                    @if(!empty($ces_trainings_rights_item))
                                                    <li>{{$ces_trainings_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->other_non_ces_accredited_trainings_rights) as $other_non_ces_accredited_trainings_rights_item)
                        
                                                    @if(!empty($other_non_ces_accredited_trainings_rights_item))
                                                    <li>{{$other_non_ces_accredited_trainings_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->research_and_studies_rights) as $research_and_studies_rights_item)
                        
                                                    @if(!empty($research_and_studies_rights_item))
                                                    <li>{{$research_and_studies_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->scholarships_received_rights) as $scholarships_received_rights_item)
                        
                                                    @if(!empty($scholarships_received_rights_item))
                                                    <li>{{$scholarships_received_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->major_civic_and_professional_affiliations_rights) as $major_civic_and_professional_affiliations_rights_item)
                        
                                                    @if(!empty($major_civic_and_professional_affiliations_rights_item))
                                                    <li>{{$major_civic_and_professional_affiliations_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->awards_and_citations_received_rights) as $awards_and_citations_received_rights_item)
                        
                                                    @if(!empty($awards_and_citations_received_rights_item))
                                                    <li>{{$awards_and_citations_received_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->case_records_rights) as $case_records_rights_item)
                        
                                                    @if(!empty($case_records_rights_item))
                                                    <li>{{$case_records_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->health_record_rights) as $health_record_rights_item)
                        
                                                    @if(!empty($health_record_rights_item))
                                                    <li>{{$health_record_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$executive_201_role_access_item->attached_pdf_files_rights) as $attached_pdf_files_rights_item)
                        
                                                    @if(!empty($attached_pdf_files_rights_item))
                                                    <li>{{$attached_pdf_files_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">{{ $executive_201_role_access_item->encoder ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($executive_201_role_access_item->created_at)) ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ $executive_201_role_access_item->last_updated_by ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($executive_201_role_access_item->updated_at)) ?? '-'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- End Executive 201 -->
                        <!-- Start Plantilla Manangement -->
                        <div class="tab-pane fade" id="plantilla_manangement" role="tabpanel" aria-labelledby="plantilla_manangement-tab">
                            <form class="user" id="plantilla_manangement_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/plantilla-manangement-access/add`, `plantilla_manangement_form`, `Add`, `updatePlantillaManangementAccessTable`, `resetPlantillaManangementAccessForm`, `plantilla_manangement_form_submit`, `None`, `None`)">
                               @csrf
                               
                               <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">ROLE NAME</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="input-group col-md-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Role Name</span>
                                        </div>
                                        <select class="form-control" id="role_name_plantilla_manangement" name="role_name_plantilla_manangement" required>
                                            <option value="">Please Select</option>
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Power User">Power User</option>
                                            <option value="Rank Officer">Rank Officer</option>
                                            <option value="CESB Operator">CESB Operator</option>
                                            <option value="Training Officer">Training Officer</option>
                                            <option value="CESPES Operator">CESPES Operator</option>
                                            <option value="Agency HR Operator">Agency HR Operator</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">PLANTILLA MANAGEMENT ACCESS</h4>
                                </div>
                                <div class="container-fuild m-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="plantilla_management_main_screen" value="Plantilla Management (Main Screen)">
                                            <label class="form-check-label">Plantilla Management (Main Screen)</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_management_main_screen_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_management_main_screen_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_management_main_screen_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_management_main_screen_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="sector_manager" value="Sector Manager">
                                            <label class="form-check-label">Sector Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="sector_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="sector_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="sector_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="sector_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="department_agency_manager" value="Department or Agency Manager">
                                            <label class="form-check-label">Department or Agency Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="department_agency_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="department_agency_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="department_agency_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="department_agency_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="agency_location_manager" value="Agency Location Manager">
                                            <label class="form-check-label">Agency Location Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="agency_location_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="agency_location_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="agency_location_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="agency_location_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="office_manager" value="Office Manager">
                                            <label class="form-check-label">Office Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="office_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="office_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="office_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="office_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="plantilla_position_manager" value="Plantilla Position Manager">
                                            <label class="form-check-label">Plantilla Position Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="plantilla_position_classification_manager" value="Plantilla Position Classification Manager">
                                            <label class="form-check-label">Plantilla Position Classification Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_classification_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_classification_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_classification_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_classification_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="appointee_occupant_manager" value="Appointee - Occupant Manager">
                                            <label class="form-check-label">Appointee - Occupant Manager</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="appointee_occupant_manager_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="appointee_occupant_manager_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="appointee_occupant_manager_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="appointee_occupant_manager_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-check-input" name="plantilla_appointee_occupant_browser" value="Plantilla Appointee or Occupant Browser">
                                            <label class="form-check-label">Plantilla Appointee or Occupant Browser</label>
                                            <ol>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_appointee_occupant_browser_rights_add" value="Add">
                                                    <label class="form-check-label">Add</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_appointee_occupant_browser_rights_edit" value="Edit">
                                                    <label class="form-check-label">Edit</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_appointee_occupant_browser_rights_delete" value="Delete">
                                                    <label class="form-check-label">Delete</label>    
                                                </ul>
                                                <ul>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_appointee_occupant_browser_rights_view_only" value="View Only">
                                                    <label class="form-check-label">View Only</label>    
                                                </ul>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container-fuild m-3">
                                    <div class="row ml-2 mt-3 mb-4">
                                        <div class="p-1">
                                            <input type="submit" id="plantilla_manangement_form_submit" class="btn btn-primary" value="Add Record">
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-white bg-secondary bg-gardient">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Role Name</th>
                                                <th scope="col">Plantilla Manangement Page Access</th>
                                                <th scope="col">Plantilla Management (Main Screen) Rights</th>
                                                <th scope="col">Sector Manager Rights</th>
                                                <th scope="col">Department or Agency Manager Rights</th>
                                                <th scope="col">Agency Location Manager Rights</th>
                                                <th scope="col">Office Manager Rights</th>
                                                <th scope="col">Plantilla Position Manager Rights</th>
                                                <th scope="col">Plantilla Position Classification Manager Rights</th>
                                                <th scope="col">Appointee - Occupant Manager Rights</th>
                                                <th scope="col">Plantilla Appointee or Occupant Browser Rights</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="PlantillaManangementAccess_tbody">
                                            @if(count($plantilla_manangement_access) === 0)

                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @endif
                                            @foreach($plantilla_manangement_access as $plantilla_manangement_access_item)

                                            <tr>
                                                <td>
                                                    <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPlantillaManangementAccessForm({{ $plantilla_manangement_access_item->id }})">Edit</a>
                                                    <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/plantilla-manangement-access/delete/{{ $plantilla_manangement_access_item->id }}`, `updatePlantillaManangementAccessTable`, `resetPlantillaManangementAccessForm`, `None`, `None`)">Delete</a>
                                                </td>
                                                <td nowrap="nowrap">{{ $plantilla_manangement_access_item->role_name_plantilla_manangement ?? '-' }}</td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->plantilla_manangement_page_access) as $plantilla_manangement_page_access_item)
                            
                                                    @if(!empty($plantilla_manangement_page_access_item))
                                                    <li>{{$plantilla_manangement_page_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->plantilla_management_main_screen_rights) as $plantilla_management_main_screen_rights_item)
                        
                                                    @if(!empty($plantilla_management_main_screen_rights_item))
                                                    <li>{{$plantilla_management_main_screen_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->sector_manager_rights) as $sector_manager_rights_item)
                        
                                                    @if(!empty($sector_manager_rights_item))
                                                    <li>{{$sector_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->department_agency_manager_rights) as $department_agency_manager_rights_item)
                        
                                                    @if(!empty($department_agency_manager_rights_item))
                                                    <li>{{$department_agency_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach    
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->agency_location_manager_rights) as $agency_location_manager_rights_item)
                        
                                                    @if(!empty($agency_location_manager_rights_item))
                                                    <li>{{$agency_location_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->office_manager_rights) as $office_manager_rights_item)
                        
                                                    @if(!empty($office_manager_rights_item))
                                                    <li>{{$office_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->plantilla_position_manager_rights) as $plantilla_position_manager_rights_item)
                        
                                                    @if(!empty($plantilla_position_manager_rights_item))
                                                    <li>{{$plantilla_position_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->plantilla_position_classification_manager_rights) as $plantilla_position_classification_manager_rights_item)
                        
                                                    @if(!empty($plantilla_position_classification_manager_rights_item))
                                                    <li>{{$plantilla_position_classification_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->appointee_occupant_manager_rights) as $appointee_occupant_manager_rights_item)
                        
                                                    @if(!empty($appointee_occupant_manager_rights_item))
                                                    <li>{{$appointee_occupant_manager_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$plantilla_manangement_access_item->plantilla_appointee_occupant_browser_rights) as $plantilla_appointee_occupant_browser_rights_item)
                        
                                                    @if(!empty($plantilla_appointee_occupant_browser_rights_item))
                                                    <li>{{$plantilla_appointee_occupant_browser_rights_item}}</li>
                                                    @endif
                                                
                                                @endforeach 
                                                </td>
                                                <td nowrap="nowrap">{{ $plantilla_manangement_access_item->encoder ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($plantilla_manangement_access_item->created_at)) ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ $plantilla_manangement_access_item->last_updated_by ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($plantilla_manangement_access_item->updated_at)) ?? '-'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- End Plantilla Manangement -->
                        <!-- Start Report Generation -->
                        <div class="tab-pane fade" id="report_generation" role="tabpanel" aria-labelledby="report_generation-tab">
                            <form class="user" id="report_generation_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/report-generation-access/add`, `report_generation_form`, `Add`, `updateReportGenerationAccessTable`, `resetReportGenerationAccessForm`, `report_generation_form_submit`, `None`, `None`)">
                                @csrf

                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">ROLE NAME</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="input-group col-md-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Role Name</span>
                                        </div>
                                        <select class="form-control" id="role_name_report_generation" name="role_name_report_generation" required>
                                            <option value="">Please Select</option>
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Power User">Power User</option>
                                            <option value="Rank Officer">Rank Officer</option>
                                            <option value="CESB Operator">CESB Operator</option>
                                            <option value="Training Officer">Training Officer</option>
                                            <option value="CESPES Operator">CESPES Operator</option>
                                            <option value="Agency HR Operator">Agency HR Operator</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">EXECUTIVE 201 PROFILE</h4>
                                    <div class="bg-danger">
                                        <h5 class="pl-3 py-2 text-light font-weight-bold">General Reports</h4>
                                    </div>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_active_and_or_retired_cesos_ces_eligibles_and_csees" value="List of Active and or or Retired CESOs, CES Eligibles and CSEEs">
                                                    <label class="form-check-label">List of Active and or or Retired CESOs, CES Eligibles and CSEEs</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_deceased_cesos_ces_eligibles_and_csees" value="List of Deceased CESOs, CES Eligibles and CSEEs">
                                                    <label class="form-check-label">List of Deceased CESOs, CES Eligibles and CSEEs</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_active_ces_w_or_wo_active_pending_cases" value="List of Active CESOs, CES Eligibles and CSEEs with and or or without Active Pending Cases">
                                                    <label class="form-check-label">List of Active CESOs, CES Eligibles and CSEEs with and or or without Active Pending Cases</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_active_ces_by_appointing_authority" value="List of Active CESOs, CES Eligibles and CSEEs (defined or filtered or grouped by appointing Authority)">
                                                    <label class="form-check-label">List of Active CESOs, CES Eligibles and CSEEs (defined or filtered or grouped by appointing Authority)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_active_ces_candidate_for_retirement" value="List of Active CESOs, CES Eligibles and CSEEs candidate for Retirement">
                                                    <label class="form-check-label">List of Active CESOs, CES Eligibles and CSEEs candidate for Retirement</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Statistical Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="age_demographics" value="Age Demographics">
                                                    <label class="form-check-label">Age Demographics</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="active_vs_retired_demographics" value="Active vs Retired Demographics">
                                                    <label class="form-check-label">Active vs Retired Demographics</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="statistic_summary_per_presidential_appointments" value="Statistic Summary per Presidential Appointments">
                                                    <label class="form-check-label">Statistic Summary per Presidential Appointments</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Reports for Placement</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree" value="List of Active and or or Retired CESOs, CES Eligibles and CSEEs (defined by Fields or Area of Expertise andoror Degree or Major)">
                                                    <label class="form-check-label">List of Active and or or Retired CESOs, CES Eligibles and CSEEs (defined by Fields or Area of Expertise andoror Degree or Major)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Reports for Birthday Cards</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_officials_per_birth_month" value="List of Officials per birth month">
                                                    <label class="form-check-label">List of Officials per birth month</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Data Portability Report</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="personal_data_sheet_based_on_201_profile_information" value="Personal Data Sheet based on 201 Profile Information">
                                                    <label class="form-check-label">Personal Data Sheet based on 201 Profile Information</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">COMPETENCY / TRAINING MANAGEMENT SUB-MODULE</h4>
                                    <div class="bg-danger">
                                        <h5 class="pl-3 py-2 text-light font-weight-bold">General Reports</h4>
                                    </div>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_per_training_conducted" value="Masterlist per Training Conducted">
                                                    <label class="form-check-label">Masterlist per Training Conducted</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Training Venue Manager Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_training_venues" value="Masterlist of Training Venues">
                                                    <label class="form-check-label">Masterlist of Training Venues</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_training_venues_by_city" value="List of Training Venues (filtered by City or Municipality)">
                                                    <label class="form-check-label">List of Training Venues (filtered by City or Municipality)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Training Provider Report</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_training_providers" value="Masterlist of Training Providers">
                                                    <label class="form-check-label">Masterlist of Training Providers</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Resource Person / Speaker Manager Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_resource_speaker_persons" value="Masterlist of Resource Speaker or Persons">
                                                    <label class="form-check-label">Masterlist of Resource Speaker or Persons</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_resource_speakers_persons_by_expertise" value="List of Resource Speakers or Persons (defined by Expertise)">
                                                    <label class="form-check-label">List of Resource Speakers or Persons (defined by Expertise)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_resource_speakers_persons_by_inclusive_date" value="List of Resource Speakers or Persons (defined by Inclusive Date)">
                                                    <label class="form-check-label">List of Resource Speakers or Persons (defined by Inclusive Date)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">ELIGIBILITY AND RANK TRACKING</h4>
                                    <div class="bg-danger">
                                        <h5 class="pl-3 py-2 text-light font-weight-bold">General Reports</h4>
                                    </div>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_officials_undergoing_the_4_stage_eligibility" value="Masterlist of Officials undergoing the 4-stage Eligibility Process (on-stream)">
                                                    <label class="form-check-label">Masterlist of Officials undergoing the 4-stage Eligibility Process (on-stream)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">CES WE Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_examinees_per_examination_date_location" value="Masterlist of Examinees per examination date, location">
                                                    <label class="form-check-label">Masterlist of Examinees per examination date, location</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_examinees_per_defined_rating_pass_or_failed" value="Masterlist of Examinees per defined rating (Pass or failed), examination date and location (variable">
                                                    <label class="form-check-label">Masterlist of Examinees per defined rating (Pass or failed), examination date and location (variable</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_ces_we_retakers" value="Masterlist of CES WE retakers (optional)">
                                                    <label class="form-check-label">Masterlist of CES WE retakers (optional)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Assessment Center Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_ac_takers_per_ac_date" value="Masterlist of AC Takers per AC date">
                                                    <label class="form-check-label">Masterlist of AC Takers per AC date</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_ac_passers_per_ac_date" value="Masterlist of AC Passers per AC date">
                                                    <label class="form-check-label">Masterlist of AC Passers per AC date</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_ac_retakers" value="Masterlist of AC Retakers">
                                                    <label class="form-check-label">Masterlist of AC Retakers</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Validation Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_validated_officials_per_validation_date_or_type" value="Masterlist of Validated Officials per Validation Date and or or Validation Type">
                                                    <label class="form-check-label">Masterlist of Validated Officials per Validation Date and or or Validation Type</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-danger">
                                    <h5 class="pl-3 py-2 text-light font-weight-bold">Board / Panel Interview Reports</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="masterlist_of_officials_who_has_taken_board_panel_interview" value="Masterlist of Officials who has taken or undergone Board or Panel Interview">
                                                    <label class="form-check-label">Masterlist of Officials who has taken or undergone Board or Panel Interview</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">PLANTILLA MANAGEMENT REPORTS</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_all" value="Plantilla Statistics (All)">
                                                    <label class="form-check-label">Plantilla Statistics (All)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_ces_only" value="Plantilla Statistics (CES Only)">
                                                    <label class="form-check-label">Plantilla Statistics (CES Only)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_non_ces_only" value="Plantilla Statistics (Non-CES Only)">
                                                    <label class="form-check-label">Plantilla Statistics (Non-CES Only)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_by_gender_all_ces_or_non_ces" value="Plantilla Statistics by Gender (All, CES or Non-CES)">
                                                    <label class="form-check-label">Plantilla Statistics by Gender (All, CES or Non-CES)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_summary_including_gender_by_agency" value="Plantilla Statistics Summary including Gender (by Agency or All)">
                                                    <label class="form-check-label">Plantilla Statistics Summary including Gender (by Agency or All)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_statistics_per_department_attached_agency_ces_position" value="Plantilla Statistics per Department, Attached Agency and CES Positions">
                                                    <label class="form-check-label">Plantilla Statistics per Department, Attached Agency and CES Positions</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="occupancy_report_all" value="Occupancy Report (All)">
                                                    <label class="form-check-label">Occupancy Report (All)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="occupancy_report_ces_only" value="Occupancy Report (CES Only)">
                                                    <label class="form-check-label">Occupancy Report (CES Only)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="occupancy_report_non_ces_only" value="Occupancy Report (Non-CES Only)">
                                                    <label class="form-check-label">Occupancy Report (Non-CES Only)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="plantilla_position_list_per_agency_based_on_classification" value="Plantilla Position List (per Agency, based on classification (CES, Non-CES or All)">
                                                    <label class="form-check-label">Plantilla Position List (per Agency, based on classification (CES, Non-CES or All)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="ces_bluebook" value="CES Bluebook">
                                                    <label class="form-check-label">CES Bluebook</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="mailing_list_per_agency" value="Mailing List per Agency (address derived from 201 Profile as stated in the mailing address and not in the office address)">
                                                    <label class="form-check-label">Mailing List per Agency (address derived from 201 Profile as stated in the mailing address and not in the office address)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_officials_by_department" value="List of Officials by Department (filtered by CES Status and Salary Grade, option to include Occupants and attached Agencies, and sorted by Name, SG, Office and Region)">
                                                    <label class="form-check-label">List of Officials by Department (filtered by CES Status and Salary Grade, option to include Occupants and attached Agencies, and sorted by Name, SG, Office and Region)</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="list_of_officials_by_appointment_or_assumption_dates" value="List of Officials by Appointment or Assumption Dates (filtered by CES status and Department or Agency)">
                                                    <label class="form-check-label">List of Officials by Appointment or Assumption Dates (filtered by CES status and Department or Agency)</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container-fuild m-3">
                                    <div class="row ml-2 mt-3 mb-4">
                                        <div class="p-1">
                                            <input type="submit" id="report_generation_form_submit" class="btn btn-primary" value="Add Record" >
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-white bg-secondary bg-gardient">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Role Name</th>
                                                <th scope="col">EXECUTIVE 201 PROFILE REPORT Access</th>
                                                <th scope="col">COMPETENCY / TRAINING MANAGEMENT SUB-MODULE REPORT Access</th>
                                                <th scope="col">ELIGIBILITY AND RANK TRACKING REPORT Access</th>
                                                <th scope="col">PLANTILLA MANAGEMENT REPORT Access</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ReportGenerationAccess_tbody">
                                            @if(count($report_generation_access) === 0)

                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @endif
                                            @foreach($report_generation_access as $report_generation_access_item)

                                            <tr>
                                                <td>
                                                    <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetReportGenerationAccessForm({{ $report_generation_access_item->id }})">Edit</a>
                                                    <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/report-generation-access/delete/{{ $report_generation_access_item->id }}`, `updateReportGenerationAccessTable`, `resetReportGenerationAccessForm`, `None`, `None`)">Delete</a>
                                                </td>
                                                <td nowrap="nowrap">{{ $report_generation_access_item->role_name_report_generation ?? '-' }}</td>
                                                <td nowrap="nowrap">
                                                @foreach(explode('|',$report_generation_access_item->rep_gen_executive_201_profile_access) as $rep_gen_executive_201_profile_access_item)

                                                    @if(!empty($rep_gen_executive_201_profile_access_item))
                                                    <li>{{$rep_gen_executive_201_profile_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode('|',$report_generation_access_item->rep_gen_competency_training_management_sub_module_access) as $rep_gen_competency_training_management_sub_module_access_item)

                                                    @if(!empty($rep_gen_competency_training_management_sub_module_access_item))
                                                    <li>{{$rep_gen_competency_training_management_sub_module_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode('|',$report_generation_access_item->rep_gen_eligibility_and_rank_tracking_access) as $rep_gen_eligibility_and_rank_tracking_access_item)

                                                    @if(!empty($rep_gen_eligibility_and_rank_tracking_access_item))
                                                    <li>{{$rep_gen_eligibility_and_rank_tracking_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">
                                                @foreach(explode('|',$report_generation_access_item->rep_gen_plantilla_management_reports_access) as $rep_gen_plantilla_management_reports_access_item)

                                                    @if(!empty($rep_gen_plantilla_management_reports_access_item))
                                                    <li>{{$rep_gen_plantilla_management_reports_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">{{ $report_generation_access_item->encoder ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($report_generation_access_item->created_at)) ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ $report_generation_access_item->last_updated_by ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($report_generation_access_item->updated_at)) ?? '-'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                             </form>
                        </div>
                        <!-- End Report Generation -->
                        <!-- Start CES Web App General Page -->
                        <div class="tab-pane fade" id="ces_web_app_general_page" role="tabpanel" aria-labelledby="ces_web_app_general_page-tab">
                            <form class="user" id="ces_web_app_general_page_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-web-app-general-page-access/add`, `ces_web_app_general_page_form`, `Add`, `updateCesWebAppGeneralPageAccessTable`, `resetCesWebAppGeneralPageAccessForm`, `ces_web_app_general_page_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">ROLE NAME</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="input-group col-md-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Role Name</span>
                                        </div>
                                        <select class="form-control" id="role_name_ces_web_app_general_page" name="role_name_ces_web_app_general_page" required>
                                            <option value="">Please Select</option>
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Power User">Power User</option>
                                            <option value="Rank Officer">Rank Officer</option>
                                            <option value="CESB Operator">CESB Operator</option>
                                            <option value="Training Officer">Training Officer</option>
                                            <option value="CESPES Operator">CESPES Operator</option>
                                            <option value="Agency HR Operator">Agency HR Operator</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">CES WEB APP GENERAL PAGE ACCESS</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_dashboard" value="Dashboard">
                                                    <label class="form-check-label">Dashboard</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_201_profiling" value="201 Profiling">
                                                    <label class="form-check-label">201 Profiling</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_plantilla" value="Plantilla">
                                                    <label class="form-check-label">Plantilla</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_competency" value="Competency">
                                                    <label class="form-check-label">Competency</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_reports" value="Reports">
                                                    <label class="form-check-label">Reports</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_rights_management" value="Rights Management">
                                                    <label class="form-check-label">Rights Management</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_system_utility" value="System Utility">
                                                    <label class="form-check-label">System Utility</label>    
                                                </li>
                                                <li>
                                                    <input class="form-check-input" type="checkbox" name="general_page_database_migration" value="Database Migration">
                                                    <label class="form-check-label">Database Migration</label>    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="container-fuild m-3">
                                    <div class="row ml-2 mt-3 mb-4">
                                        <div class="p-1">
                                            <input type="submit" id="ces_web_app_general_page_form_submit" class="btn btn-primary" value="Add Record" >
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-white bg-secondary bg-gardient">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Role Name</th>
                                                <th scope="col">CES Web App General Page Access</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CesWebAppGeneralPageAccess_tbody">
                                            @if(count($ces_web_app_general_page_access) === 0)

                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @endif
                                            @foreach($ces_web_app_general_page_access as $ces_web_app_general_page_access_item)

                                            <tr>
                                                <td>
                                                    <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesWebAppGeneralPageAccessForm({{ $ces_web_app_general_page_access_item->id }})">Edit</a>
                                                    <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-web-app-general-page-access/delete/{{ $ces_web_app_general_page_access_item->id }}`, `updateCesWebAppGeneralPageAccessTable`, `resetCesWebAppGeneralPageAccessForm`, `None`, `None`)">Delete</a>
                                                </td>
                                                <td nowrap="nowrap">{{ $ces_web_app_general_page_access_item->role_name_ces_web_app_general_page ?? '-' }}</td>
                                                <td nowrap="nowrap">
                                                @foreach(explode(',',$ces_web_app_general_page_access_item->ces_web_app_general_page_access) as $page_access_item)

                                                    @if(!empty($page_access_item))
                                                    <li>{{$page_access_item}}</li>
                                                    @endif
                                                
                                                @endforeach
                                                </td>
                                                <td nowrap="nowrap">{{ $ces_web_app_general_page_access_item->encoder ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($ces_web_app_general_page_access_item->created_at)) ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ $ces_web_app_general_page_access_item->last_updated_by ?? '-'}}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($ces_web_app_general_page_access_item->updated_at)) ?? '-'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                             </form>
                        </div>
                        <!-- End CES Web App General Page -->
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
