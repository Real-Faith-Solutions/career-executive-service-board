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
            <script>setPageTitle('Online Ces Plantilla Management System');</script>
            <div class="container-fluid border border-primary py-3 pt-3">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="plantilla_management_main_screen-tab" data-bs-toggle="tab" href="#plantilla_management_main_screen" role="tab" aria-controls="home" aria-selected="true">Plantilla Management Main Screen</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sector_manager-tab" data-bs-toggle="tab" href="#sector_manager" role="tab" aria-controls="home" aria-selected="true">Sector Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="department_agency_manager-tab" data-bs-toggle="tab" href="#department_agency_manager" role="tab" aria-controls="home" aria-selected="true">Department / Agency Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="agency_location_manager-tab" data-bs-toggle="tab" href="#agency_location_manager" role="tab" aria-controls="home" aria-selected="true">Agency Location Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="office_manager-tab" data-bs-toggle="tab" href="#office_manager" role="tab" aria-controls="home" aria-selected="true">Office Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="plantilla-position-manager-tab" data-bs-toggle="tab" href="#plantilla-position-manager" role="tab" aria-controls="home" aria-selected="true">Plantilla Position Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="appointee_occupant_manager-tab" data-bs-toggle="tab" href="#appointee_occupant_manager" role="tab" aria-controls="home" aria-selected="true">Appointee Occupant Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="appointee_occupant_browser-tab" data-bs-toggle="tab" href="#appointee_occupant_browser" role="tab" aria-controls="home" aria-selected="true">Appointee Occupant Browser</a>
                        </li>
                    </ul>
                </div>
            </div>
    <div class="border border-primary">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent"> 
<!-- PLANTILLA MANAGEMENT MAIN SCREEN -->
                        <div class="tab-pane fade show active" id="plantilla_management_main_screen" role="tabpanel" aria-labelledby="plantilla_management_main_screen-tab">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">PLANTILLA MANAGEMENT MAIN SCREEN</h4>
                                    </div>
                                    <div class="overflow-auto">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-dark bg-light">
                                                <tr>
                                                    <th scope="col">Sector</th>
                                                    <th scope="col">List Of Department / Agency Per Sector</th>
                                                    <th scope="col">List Of Office Location Per Deparment Agency</th>
                                                    <th scope="col">List Of Office Per Office Location</th>
                                                    <th scope="col">List Of Positions Per Office</th>
                                                    <th scope="col">Appointee Occupant Per Office</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                <tr>
                                                    <td>plantilla_tblSector->title</td>
                                                    <td>plantilla_tblDeptAgency->title</td>
                                                    <td>plantilla_tblAgencyLocation->title</td>
                                                    <td>plantilla_tblOffice->floor_bldg</td>
                                                    <td>plantillalib_tblPositionLevel->title</td>
                                                    <td>table_6</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- end PLANTILLA MANAGEMENT MAIN SCREEN -->
<!-- sector manager -->
                        <div class="tab-pane fade " id="sector_manager" role="tabpanel" aria-labelledby="sector_manager-tab">
                            <form class="user" id="personal_data" method="POST" action="javascript:void(0);" onsubmit="submitPersonalDataForms('{{ env('APP_URL') }}api/v1/personal-data/add', 'personal_data')">
                               @csrf
                               <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">SECTOR MANAGER</h4>
                                </div>
                                <div class="row m-2">
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Sector ID </label>
                                        <input type="text" name="sectorid" class="form-control w-100 mb-3" placeholder="must be auto generated">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Sector Name</label>
                                        <input type="text" name="title" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-12">
                                        <label class="form-label ml-2 mb-0">Description</label>
                                        <textarea name="description" class="form-control w-100 mb-3"></textarea>
                                    </div>
                                </div>
                                <div class="row ml-1 my-4">
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Edit Record" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-primary" value="Add Record" >
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-dark bg-light">
                                            <tr>
                                                <th scope="col">Sector ID</th>
                                                <th scope="col">Sector Name</th>
                                                <th scope="col">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td>plantilla_tblSector->sectorid</td>
                                                <td>plantilla_tblSector->title</td>
                                                <td>plantilla_tblSector->description</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
<!-- end sector manager -->
<!-- DEPARTMENT / AGENCY MANAGER -->
                        <div class="tab-pane fade" id="department_agency_manager" role="tabpanel" aria-labelledby="department_agency_manager-tab">
                            <form class="user" id="personal_data" method="POST" action="javascript:void(0);" onsubmit="submitPersonalDataForms('{{ env('APP_URL') }}api/v1/personal-data/add', 'personal_data')">
                               @csrf
                               <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">DEPARTMENT / AGENCY MANAGER</h4>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Department ID </label>
                                        <input type="text" name="department_id" class="form-control w-100 mb-3" placeholder="must be auto generated">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Mother Agency</label>
                                        <input type="text" name="mother_agency" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Agency Bureau</label>
                                        <input type="text" name="agency_bureau" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Agency Bureau Acronym</label>
                                        <input type="text" name="agency_bureau_acronym" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Type</label>
                                        <input type="text" name="office_type" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Agency Website</label>
                                        <input type="text" name="agency_website" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">last Submission Date</label>
                                        <input type="date" name="last_submission_date" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Submitted By</label>
                                        <input type="text" name="agency_website" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-12">
                                        <label class="form-label ml-2 mb-0">Remarks</label>
                                        <textarea type="text" name="remarks_department_agency_manager" class="form-control w-100 mb-3"></textarea>
                                    </div>
                                </div>
                                <div class="row ml-1 my-4">
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Edit Record" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-primary" value="Add Record" >
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-dark bg-light">
                                            <tr>
                                                <th scope="col">Department ID</th>
                                                <th scope="col">Mother Agency</th>
                                                <th scope="col">Agency Bureau</th>
                                                <th scope="col">Agency Bureau Acronym</th>
                                                <th scope="col">Office Type</th>
                                                <th scope="col">Agency Website</th>
                                                <th scope="col">last Submission Date</th>
                                                <th scope="col">Submitted By</th>
                                                <th scope="col">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td>plantilla_tblDeptAgency->deptid</td>
                                                <td>plantilla_tblDeptAgency->motherdeptid</td>
                                                <td>clarify</td>
                                                <td>plantilla_tblDeptAgency->acronym</td>
                                                <td>clarify</td>
                                                <td>plantilla_tblDeptAgency->website</td>
                                                <td>plantilla_tblDeptAgency->lastsubmit_dt</td>
                                                <td>plantilla_tblDeptAgency->submitted_by</td>
                                                <td>plantilla_tblDeptAgency->remarks</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
<!-- end DEPARTMENT / AGENCY MANAGER -->
<!-- AGENCY LOCATION MANAGER -->
                        <div class="tab-pane fade" id="agency_location_manager" role="tabpanel" aria-labelledby="agency_location_manager-tab">
                            <form class="user" id="personal_data" method="POST" action="javascript:void(0);" onsubmit="submitPersonalDataForms('{{ env('APP_URL') }}api/v1/personal-data/add', 'personal_data')">
                               @csrf
                               <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">AGENCY LOCATION MANAGER</h4>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Location ID</label>
                                        <input type="text" name="officelocid" class="form-control w-100 mb-3" placeholder="must be auto generated">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Location</label>
                                        <input type="text" name="location" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Location Acronym</label>
                                        <input type="text" name="location_acronym" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Location Type</label>
                                        <input type="text" name="location_type" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Region</label>
                                        <input type="text" name="region" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row ml-1 my-4">
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Edit Record" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-primary" value="Add Record" >
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-dark bg-light">
                                            <tr>
                                                <th scope="col">Location ID</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Location Acronym</th>
                                                <th scope="col">Location Type</th>
                                                <th scope="col">Region</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td>plantilla_tblAgencyLocation->officelocid</td>
                                                <td>clarify</td>
                                                <td>plantilla_tblAgencyLocation->acronym</td>
                                                <td>plantilla_tblAgencyLocation->loctype_id</td>
                                                <td>plantilla_tblAgencyLocation->region</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
<!-- end AGENCY LOCATION MANAGER -->
<!-- OFFICE MANAGER -->
                        <div class="tab-pane fade" id="office_manager" role="tabpanel" aria-labelledby="office_manager-tab">
                            <form class="user" id="personal_data" method="POST" action="javascript:void(0);" onsubmit="submitPersonalDataForms('{{ env('APP_URL') }}api/v1/personal-data/add', 'personal_data')">
                               @csrf
                               <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">OFFICE MANAGER</h4>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office ID</label>
                                        <input type="text" name="office_id" class="form-control w-100 mb-3" placeholder="must be auto generated">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office</label>
                                        <input type="text" name="office" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Acronym</label>
                                        <input type="text" name="office_acronym" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Website</label>
                                        <input type="text" name="office_website" class="form-control w-100 mb-3" placeholder="drived from agency website data field">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Contact No.</label>
                                        <input type="text" name="office_contact_no" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Email Address</label>
                                        <input type="text" name="office_email_address" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Office Status</label>
                                        <select class="form-select form-control" aria-label="Office Status" name="office_status">
                                            <option selected>Select</option>
                                            <option value="Active">Active</option>
                                            <option value="In-Active">In-Active</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">OFFICE ADDRESS</h4>
                                    </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Floor / bldg.</label>
                                        <input type="text" name="floor_bldg" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">No. / Street</label>
                                        <input type="text" name="no_street" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Brgy. / District</label>
                                        <input type="text" name="brgy_district" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">City / Municipality</label>
                                        <input type="text" name="city_municipality" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row ml-1 my-4">
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Edit Record" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-primary" value="Add Record" >
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-dark bg-light">
                                            <tr>
                                                <th scope="col">Office ID</th>
                                                <th scope="col">Office</th>
                                                <th scope="col">Office Acronym</th>
                                                <th scope="col">Office Website</th>
                                                <th scope="col">Office Contact No.</th>
                                                <th scope="col">Office Email Address</th>
                                                <th scope="col">Office Status</th>
                                                <th scope="col">Floor / bldg.</th>
                                                <th scope="col">No. / Street</th>
                                                <th scope="col">Brgy. / District</th>
                                                <th scope="col">City / Municipality</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
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
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
<!-- end OFFICE MANAGER -->
<!-- PLANTILLA POSITION MANAGER -->
                        <div class="tab-pane fade" id="plantilla-position-manager" role="tabpanel" aria-labelledby="plantilla-position-manager-tab">
                            <form class="user" id="personal_data" method="POST" action="javascript:void(0);" onsubmit="submitPersonalDataForms('{{ env('APP_URL') }}api/v1/personal-data/add', 'personal_data')">
                               @csrf
                                <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">PLANTILLA POSITION MANAGER</h4>
                                </div>
                                <div class="m-2 p-3">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#plantillaPositionClarificationManager">
                                        Plantilla Position Classification Manager
                                    </button>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Plantilla ID</label>
                                        <input type="text" name="plantilla_id" class="form-control w-100 mb-3" placeholder="must be auto generated">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Plantilla Position</label>
                                        <input type="text" name="plantilla_position" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Sallary Grade</label>
                                        <input type="text" name="salary_grade" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Plantilla Position Suffix</label>
                                        <input type="text" name="plantilla_position_suffix" class="form-control w-100 mb-3" placeholder="drived from agency website data field">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">DBM Position Title</label>
                                        <input type="text" name="dbm_position_title" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label ml-2 mb-0">Functional Position Title</label>
                                        <input type="text" name="functional_position_title" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Plantilla Position DBM Item No.</label>
                                        <input type="text" name="plantilla_position_dbm_item_no" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">CES Position</label>
                                        <input type="text" name="ces_position" class="form-control w-100 mb-3" placeholder="boolean">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Presidential Appointee</label>
                                        <input type="text" name="presidential_appointee" class="form-control w-100 mb-3" placeholder="boolean">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Position Status</label>
                                        <select class="form-select form-control mb-3" aria-label="Position Status" name="position_status">
                                            <option selected>Select</option>
                                            <option value="Active">Active</option>
                                            <option value="In-Active">In-Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-12">
                                        <label class="form-label ml-2 mb-0">Remarks</label>
                                        <textarea type="text" name="remarks_plantilla_position_manager" class="form-control w-100 mb-3"></textarea>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Position Classification Basis</label>
                                        <input type="text" name="position_classification_basis" class="form-control w-100 mb-3">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ml-2 mb-0">Position Classification Title</label>
                                        <input type="text" name="position_classification_title" class="form-control w-100 mb-3">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-12">
                                        <label class="form-label ml-2 mb-0">Position Classification Remarks / Notes</label>
                                        <textarea type="text" name="position_classification_remarks_notes" class="form-control w-100 mb-3" ></textarea>
                                    </div>
                                </div>
                                <div class="row ml-1 my-4">
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Edit Record" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-primary" value="Add Record" >
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-dark bg-light">
                                            <tr>
                                                <th scope="col">Plantilla ID</th>
                                                <th scope="col">Plantilla Position</th>
                                                <th scope="col">Sallary Grade</th>
                                                <th scope="col">Plantilla Position Suffix</th>
                                                <th scope="col">DBM Posstion Title</th>
                                                <th scope="col">Functional Position Title</th>
                                                <th scope="col">Plantilla Position DBM Item No.</th>
                                                <th scope="col">CES Position</th>
                                                <th scope="col">Presidential Appointee</th>
                                                <th scope="col">Position Status</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Position Classification Bases</th>
                                                <th scope="col">Position Classification Title</th>
                                                <th scope="col">Position Classification Remarks / Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- The Modal plantilla position manager -->
                        <div class="modal" id="plantillaPositionClarificationManager">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-warning">PLANTILLA POSITION CLASSIFICATION MANAGER</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row m-2">
                                            <div class="col-4">
                                                <label class="form-label ml-2 mb-0">Position Classification Basis</label>
                                                <input type="text" name="position_classification_basis_modal" class="form-control w-100 mb-3">
                                            </div>
                                        </div>
                                        <div class="row m-2">
                                            <div class="col-12">
                                                <label class="form-label ml-2 mb-0">Position Classification Title / Description</label>
                                                <textarea type="text" name="position_classification_title_description_modal" class="form-control w-100 mb-3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row m-2">
                                            <div class="col-4">
                                                <label class="form-label ml-2 mb-0">Position Classification Date</label>
                                                <input type="date" name="position_classification_date_modal" class="form-control w-100 mb-3">
                                            </div>
                                        </div>
                                        <div class="row m-2">
                                            <div class="col-12">
                                                <label class="form-label ml-2 mb-0">Position Classification Remarks / Notes</label>
                                                <textarea type="text" name="position_classification_remarks_notes_modal" class="form-control w-100 mb-3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button onclick="" type="submit" class="btn btn-success">Edit Record</button>
                                        <button onclick="" type="submit" class="btn btn-primary">Add Record</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal plantilla position manager-->
<!-- end PLANTILLA POSITION MANAGER -->
<!-- APPOINTEE - OCCUPANT MANAGER -->
                        <div class="tab-pane fade show" id="appointee_occupant_manager" role="tabpanel" aria-labelledby="appointee_occupant_manager-tab">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">APPOINTEE - OCCUPANT MANAGER</h4>
                                    </div>
                                    <div class="m-2 p-3">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#appointeeOccupantManager">
                                            Occupant Information
                                        </button>
                                    </div>
                                    <div class="overflow-auto">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-dark bg-light">
                                                <tr>
                                                    <th scope="col">Department / Agency</th>
                                                    <th scope="col">Officie Location</th>
                                                    <th scope="col">Office</th>
                                                    <th scope="col">Ces Level / CES Position Equivalent</th>
                                                    <th scope="col">Sallary Grade</th>
                                                    <th scope="col">DBM Position Title</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                <tr>
                                                    <td>plantilla_tblDeptAgency->title</td>
                                                    <td>plantilla_tblOffice_Addr->floor_bldg, plantilla_tblOffice_Addr->house_no_st, plantilla_tblOffice_Addr->brgy_dist, plantilla_tblOffice_Addr->city_code</td>
                                                    <td>plantilla_tblOffice->title</td>
                                                    <td>plantillalib_tblPositionLevel->title, plantillalib_tblPositionLevel->pl_func_name</td>
                                                    <td>plantillalib_tblPositionLevel->sg</td>
                                                    <td>plantillalib_tblPositionLevel->dbm_title</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                        <!-- The Modal appointee - occupant manager  -->
                        <div class="modal" id="appointeeOccupantManager">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-warning">OCCUPANT INFORMATION</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">Personel Movement</label>
                                                <select class="form-select form-control" aria-label="Office Status" name="">
                                                    <option selected>Drop Down List</option>
                                                    <option value="test1">tes1t</option>
                                                    <option value="test2">test2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">Name of Official</label>
                                                <select class="form-select form-control" aria-label="Office Status" name="">
                                                    <option selected>Drop Down List</option>
                                                    <option value="test1">tes1t</option>
                                                    <option value="test2">test2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">CES Status</label>
                                                <input type="text" name="" class="form-control w-100 mb-3" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">Gender</label>
                                                <input type="text" name="" class="form-control w-100 mb-3" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">Appointment Date</label>
                                                <input type="date" name="" class="form-control w-100 mb-3">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label ml-2 mb-0">Assumption Date</label>
                                                <input type="date" name="" class="form-control w-100 mb-3">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label ml-2 mb-0">Special Assignment</label>
                                                <input type="text" name="" class="form-control w-100 mb-3" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label ml-2 mb-0">Basis</label>
                                                <textarea type="text" name="" class="form-control w-100 mb-3" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button onclick="" type="submit" class="btn btn-success">Edit Record</button>
                                        <button onclick="" type="submit" class="btn btn-primary">Add Record</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal appointee - occupant manager -->                                         
<!-- end APPOINTEE - OCCUPANT MANAGER -->
<!-- APPOINTEE / OCCUPANT BROWSER -->
                        <div class="tab-pane fade show" id="appointee_occupant_browser" role="tabpanel" aria-labelledby="appointee_occupant_browser-tab">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="bg-primary">
                                        <h4 class="pl-3 py-2 text-warning font-weight-bold">APPOINTEE / OCCUPANT BROWSER</h4>
                                    </div>
                                    <div class="m-2 p-3">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#actualDisplayOfView">
                                            Actual Display of View
                                        </button>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Sector</label>
                                            <select class="form-select form-control" aria-label="Office Status" name="">
                                                <option selected>Drop Down List</option>
                                                <option value="test1">tes1t</option>
                                                <option value="test2">test2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Department / Agency</label>
                                            <select class="form-select form-control" aria-label="Office Status" name="">
                                                <option selected>Drop Down List</option>
                                                <option value="test1">tes1t</option>
                                                <option value="test2">test2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Include Attached Agencies / Bureaus</label>
                                            <input type="text" name="" class="form-control w-100 mb-3" readonly>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="bg-primary">
                                                <h4 class="pl-3 py-2 text-warning font-weight-bold">PLANTILLA AS OF DATE</h4>
                                            </div>
                                            <div class="overflow-auto">
                                                <table class="table table-responsive-lg table-hover">
                                                    <thead class="text-dark bg-light">
                                                        <tr>
                                                            <th scope="col">Plantilla</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="">
                                                        <tr>
                                                            <td>plantilla</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="bg-primary">
                                                <h4 class="pl-3 py-2 text-warning font-weight-bold">MOTHER DEPARTMENT</h4>
                                            </div>
                                            <div class="overflow-auto">
                                                <table class="table table-responsive-lg table-hover">
                                                    <thead class="text-dark bg-light">
                                                        <tr>
                                                            <th scope="col">Mother Department</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody class="">
                                                        <tr>
                                                            <td>mother_department</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                        <!-- The Modal APPOINTEE / OCCUPANT BROWSER  -->
                        <div class="modal" id="actualDisplayOfView">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-warning">ACTUAL DISPLAY OF VIEW</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="overflow-auto col-md-12">
                                                <table class="table table-responsive-lg table-hover">
                                                    <thead class="text-dark bg-light">
                                                        <tr>
                                                            <th scope="col">Office Location</th>
                                                            <th scope="col">Office</th>
                                                            <th scope="col">DBM Position Title</th>
                                                            <th scope="col">Salary Grade</th>
                                                            <th scope="col">DBM Item No.</th>
                                                            <th scope="col">Appointee</th>
                                                            <th scope="col">Appointee Status</th>
                                                            <th scope="col">Occupant</th>
                                                            <th scope="col">Occupant Status</th>
                                                            <th scope="col">Position Classification Basis</th>
                                                            <th scope="col">Position Classification Title / Description</th>
                                                            <th scope="col">Position Classification Date</th>
                                                            <th scope="col">Position Classification Remarks / Notes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="">
                                                        <tr>
                                                            <td>plantilla_tblOffice_Addr->floor_bldg, plantilla_tblOffice_Addr->house_no_st, plantilla_tblOffice_Addr->brgy_dist, plantilla_tblOffice_Addr->city_code</td>
                                                            <td>plantilla_tblOffice->title</td>
                                                            <td>plantilla_tblOffice->dbm_title</td>
                                                            <td>plantilla_tblOffice->sg</td>
                                                            <td>plantilla_tblOffice->pos_code</td>
                                                            <td>need_to_clarify</td>
                                                            <td>plantillalib_tblApptStatus->title</td>
                                                            <td>need_to_clarify</td>
                                                            <td>need_to_clarify</td>
                                                            <td>plantillalib_tblClassBasis->basis</td>
                                                            <td>plantillalib_tblClassBasis->title</td>
                                                            <td>plantillalib_tblClassBasis->date</td>
                                                            <td>need_to_clarify</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal APPOINTEE / OCCUPANT BROWSER -->                                         
<!-- end APPOINTEE / OCCUPANT BROWSER -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitPersonalDataForms(urls, formName, modalName){
        const url = urls;
        fetch(url, {
            method : "POST",
            body: new FormData(document.getElementById(formName)),
        }).then(
            response => response.text() // .json(), etc.
            // same as function(response) {return response.text();}
        ).then(
            html => console.log(html)
        );

        $('#'+modalName).modal('hide');
        // window.location = "http://127.0.0.1:8000/admin/profile/view";
        }
    </script>
    <script>
        function getAge(dob) { return ~~((new Date()-new Date(dob))/(31556952000)) }
        $("dob").val()
        $("input.mydob").change(function(){
        $('.age').val(getAge($(this).val()));
        });
    </script>
    <script>
        $('.noNotallow').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
        });
    </script>
    <script>
        $(".Mn").keyup(function(){
        update();
        });
        function update() {
        $(".Mi").val($('.Mn').val()[0]);
        }
    </script>
    <script>$(function() {
        $('.citizenShip').change(function(e) { 
        var selected_type = $(this).val(); 
        
        if (selected_type == 'Dual Citizenship') {

            $('#inputcitizenShip').removeAttr('disabled'); 
        }
        else if (selected_type) { 
            $('#inputcitizenShip').attr('disabled', 'disabled'); 
        }
        });
    });
    </script>
    <script>
        document.getElementById('sppd_CheckB').onchange = function() {
            document.getElementById('sppd_ip_TxtB').disabled = !this.checked;
        }
        document.getElementById('moig_CheckB').onchange = function() {
            document.getElementById('moig_TxtB').disabled = !this.checked;
        }
    </script>
    <script>
        var min = 1;
        var max = 999;
        var stop = 2

        var numbers = [];

        for (let i = 0; i < stop; i++) {
        var n =  Math.floor(Math.random() * max) + min;
        var check = numbers.includes(n);
        
        if(check === false) {
            numbers.push(n);
        } else {
            while(check === true){
            n = Math.floor(Math.random() * max) + min;
            check = numbers.includes(n);
                if(check === false){
                numbers.push(n);
                }
            }
        }
        }

        sort();

        function sort() {
        numbers.sort(function(a, b){return a-b});
        document.getElementById("ces_number").innerHTML = numbers.join("");
        }
    </script>
    </section>
</div>
@endsection
