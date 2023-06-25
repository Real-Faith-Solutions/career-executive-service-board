@extends('layout')

@section('content')

<style>
    .nav-pills .nav-link {
        border: 1px solid #111;
        margin: 4px;
    }
</style>

<div class="container-fluid @if (str_contains(Request::url(),'competency-management-system/view')) row @endif">
    <!-- Main content -->

    <script>setPageTitle('Career Excutive Competency Management System');</script>

    <section class="col-md-3">
        <div>
            <form class="d-flex" action="{{ url('admin/competency-management-system/view') }}" role="search" method="post">
                @csrf
                <div class="input-group">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search here..." @if (!empty($search)) value="{{ $search }}" @endif>
                    <input class="form-control btn btn-primary" type="submit" value="Search">
                </div>
            </form>
            <div class="bg-white my-3">
                <table class="table table-striped display-6 text-black">
                    <thead class="text-white bg-secondary bg-gardient">
                        <tr>
                            <th scope="col">Ces No.</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($searched) === 0)

                        <tr>
                            <td class="text-danger">-</td>
                            <td class="text-danger">No result found</td>
                        </tr>
                        @else
                        @foreach ($searched as $item)

                        <tr>
                            <td>
                                <a href="{{ env('APP_URL') }}admin/competency-management-system/views/{{ $item->cesno }}">{{ $item->cesno }}</a>
                            </td>
                            <td>
                                <a href="{{ env('APP_URL') }}admin/competency-management-system/views/{{ $item->cesno }}">{{$item->lastname}}, {{$item->firstname}} {{$item->middlename}}</a>
                                <a class="badge badge-pill badge-danger float-right" style="display:none">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="content col-md-9">
        <div class="@if(Auth::user()->role == 'User') p-3 pb-5 @else p-3 pb-5 @endif bg-primary text-warning text-left">
                @foreach ($personalData as $item)
            <img id="profile_picture" src="{{ ($item->picture == '' ? asset('images/person.png') : asset('external-storage/Photos/201 Photos/'. $item->picture)) }}" onerror="this.src = '{{ asset('images/person.png') }}'" class="mt-2 mr-3 rounded bg-light float-right" height="190" width="190" alt="...">
            <div class="p-4">
                <div class="row text-white ml-4">
                    <div class="col-auto mt-2 mr-3 p-0">
                        <h3 class="h6">CES No. <span class="bg-danger py-1 px-2 rounded h6">{{ $item->cesno }}</span></h3>  
                    </div>
                @endforeach
                    <div class="col-auto mt-2 mr-3 p-0">
                        <h3 class="h6">Ac No. <span id="profile_ac_no" class="bg-danger py-1 px-2 rounded h6">@if($AssessmentCenter == '[]')---@else @foreach($AssessmentCenter as $item){{ $loop->last ? $item->an_achr_ces_we : ''}}@endforeach @endif</span></h3>
                    </div>
                    <div class="col-auto mt-2 mr-3 p-0">
                        <h3 class="h6">CES Status: <span id="profile_ces_status" class="@foreach ($personalData as $item) @if($item->status == 'Retired') bg-danger @elseif($item->status == 'Deceased') bg-dark @else bg-success @endif @endforeach py-1 px-2 rounded h6">@if($CesStatus == '[]')---@else @foreach($CesStatus as $item){{ $loop->last ? $item->cs_cs_ces_we : '' }}@endforeach @endif</span></h3>
                    </div>
                </div>
                @foreach ($personalData as $item)

                <h1 class="text-dark text-success font-weight-bold display-4 text-uppercase">
                    <span id="profile_lastname">{{ $item->lastname }}</span>, <span id="profile_firstname">{{ $item->firstname }}</span> <span id="profile_middlename">{{ $item->middlename }}</span>
                </h1>
                @endforeach
            </div>
        </div>
                <div class="container-fluid border border-primary py-3 pt-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="address_and_contact_info-tab" data-bs-toggle="tab" href="#address_and_contact_info" role="tab" aria-controls="home" aria-selected="true">Address and Contact Information</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="manage_training_session-tab" data-bs-toggle="tab" href="#manage_training_session" role="tab" aria-controls="home" aria-selected="true">Manage Training Sessions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="training_type_library-tab" data-bs-toggle="tab" href="#training_type_library" role="tab" aria-controls="home" aria-selected="true">Training Type Library</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="training_venue_manager-tab" data-bs-toggle="tab" href="#training_venue_manager" role="tab" aria-controls="home" aria-selected="true">Training Venue Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="training_provider_manager-tab" data-bs-toggle="tab" href="#training_provider_manager" role="tab" aria-controls="home" aria-selected="true">Training Provider Manager</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a class="nav-link" id="resource_speakers_persons_manager-tab" data-bs-toggle="tab" href="#resource_speakers_persons_manager" role="tab" aria-controls="home" aria-selected="true">Resource Persons Manager</a>
                        </li>
                    </ul>
                </div>
            
                <div class="border border-primary">
                    <div class="tab-content" id="myTabContent">
                        <!-- start ADDRESS AND CONTACT INFORMATION -->
                        <div class="tab-pane fade show active" id="address_and_contact_info" role="tabpanel" aria-labelledby="address_and_contact_info-tab">  
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">ADDRESS AND CONTACT INFORMATION</h4>
                            </div>
                            <div class="container-fuild m-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label ml-2 mb-0">Mailing Address</label>
                        
                                        <textarea name="" id="" cols="30" rows="3" class="form-control mb-3" readonly></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Office Tel. No. (Landline)</label>
                                        <input type="number" id="" name="" class="form-control mb-3" placeholder="format: +63 (area code) + ####-####)" value="" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Office Mobile. Number 1.</label>
                                        <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Official Email Address </label>
                                        <input type="number" id="" name="" class="form-control mb-3" value="" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Office Mobile. Number 2.</label>
                                        <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="" readonly>
                                    </div>
                                </div>
                                <!-- start modal 1 -->
                                <div class="float-right">
                                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#update_contact_information_modal">
                                        Update Contact Information
                                    </button>
                                </div>
                                <!-- The Modal -->
                                <div class="modal" id="update_contact_information_modal">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Contact Information</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container-fuild m-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="form-label ml-2 mb-0">Mailing Address</label>

                                                            <textarea name="" id="" cols="30" rows="3" class="form-control mb-3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label ml-2 mb-0">Office Tel. No. (Landline)</label>
                                                            <input type="number" id="" name="" class="form-control mb-3" placeholder="format: +63 (area code) + ####-####)" value="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label ml-2 mb-0">Office Mobile. Number 1.</label>
                                                            <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label ml-2 mb-0">Official Email Address </label>
                                                            <input type="number" id="" name="" class="form-control mb-3" value="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label ml-2 mb-0">Office Mobile. Number 2.</label>
                                                            <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success">Update</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!-- end modal 1 -->
                            </div>
                            <!-- start RECORD OF CES TRAININGS ATTENDED -->
                            <div class="bg-primary mt-5">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">RECORD OF CES TRAININGS ATTENDED</h4>
                            </div>
                            <div class="overflow-auto">
                                <table class="table table-responsive-lg table-hover">
                                    <thead class="text-white bg-secondary bg-gardient">
                                        <tr>
                                            <th scope="col">From</th>
                                            <th scope="col">to</th>
                                            <th scope="col">Session Title / Program</th>
                                            <th scope="col">Session Number</th>
                                            <th scope="col">Training Category / Type</th>
                                            <th scope="col">Expertise / Field of Specialization</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">No. of Training Hours</th>
                                            <th scope="col">Barrio</th>
                                            <th scope="col">Resource Speaker</th>
                                            <th scope="col">Session Director</th>
                                            <th scope="col">Training Status</th>
                                            <th scope="col">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end RECORD OF CES TRAININGS ATTENDED -->
                            <!-- start OTHER NON-CES ACCREDITED TRAININGS -->
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">OTHER NON-CES ACCREDITED TRAININGS</h4>
                            </div>
                            <div class="overflow-auto">
                                <table class="table table-responsive-lg table-hover">
                                    <thead class="text-white bg-secondary bg-gardient">
                                        <tr>
                                            <th scope="col">From</th>
                                            <th scope="col">to</th>
                                            <th scope="col">Training Title</th>
                                            <th scope="col">Training Category / Type</th>
                                            <th scope="col">Expertise / Field of Specialization </th>
                                            <th scope="col">Sponsor / Training Provider</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">No. of Training Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr>
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
                                 <!-- start modal 2 -->
                                <div class="container-fluid">
                                    <div class="float-right mb-3">
                                        <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#add_other_trainings_modal">
                                            Add Other Trainings
                                        </button>
                                    </div>
                                    <!-- The Modal -->
                                    <div class="modal" id="add_other_trainings_modal">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Other Trainings</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="container-fuild m-3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label ml-2 mb-0">Training Title</label>
                                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-label  mr-0 mb-0">Training Provider</label>
                                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-2 mt-4">
                                                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#add_training_provider">
                                                                        ...
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Venue</label>
                                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">From</label>
                                                                <input type="date" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">to</label>
                                                                <input type="date" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success">Add New</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- start modal 3 -->
                                    <div class="container-fluid">
                                        
                                        <!-- The Modal -->
                                        <div class="modal" id="add_training_provider">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Training Provider</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="container-fuild m-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Search Provider</label>
                                                                    <select name="" class="form-control w-100 mb-3">
                                                                        <option value="">Please Select</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label ml-2 mb-0">Training Provider</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Address Bldg.</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">No/Street</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Barangay</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Contact No.</label>
                                                                    <input type="number" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Email Address.</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Contact Person</label>
                                                                    <input type="text" id="" name="" class="form-control mb-3" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success">Add New</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal 3 -->
                                </div>
                                <!-- end modal 2 -->

                            </div>
                            <!-- end OTHER NON-CES ACCREDITED TRAININGS -->
                        </div>
                        <!-- end ADDRESS AND CONTACT INFORMATION -->
                        <!-- start CES TRAINING SESSIONS -->
                        <div class="tab-pane fade" id="manage_training_session" role="tabpanel" aria-labelledby="manage_training_session-tab">  
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">CES TRAINING SESSIONS</h4>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <form class="d-flex">
                                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                            <button class="btn bg-primary btn-outline-primary text-white" type="submit">Search</button>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-text">Category</div>
                                            <div>
                                                <select id="inlineFormInputGroup" name="" class="form-control w-100">
                                                    <option value="" class="">Please Select Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-success col" data-bs-toggle="modal" data-bs-target="#add_training_session">
                                            Add Training Session
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-primary mt-2">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">TRAINING SESSION LIST</h4>
                            </div>
                            <div class="overflow-auto h-25">
                                <table class="table table-responsive-lg table-hover">
                                    <thead class="text-white bg-secondary bg-gardient">
                                        <tr>
                                            <th scope="col">SID</th>
                                            <th scope="col">Session Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr>
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
                            <div class="bg-primary mt-2">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">LIST OF PARTICIPANTS: CES CLUB: ""</h4>
                            </div>
                            <div class="row">
                                <div class="container-fluid col-md-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Session title</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Category</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Field of Spec</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="form-label ml-2 mb-0">Date From:</label>
                                            <input type="date" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label ml-2 mb-0">To:</label>
                                            <input type="date" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Number of Hours</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Vanue</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">bario</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Resource Person</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Session Director</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Status</label>
                                            <input type="text" id="" name="" class="form-control mb-1"  value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label ml-2 mb-0">Remarks</label>
                                            <textarea class="form-control mb-3" name="" id="" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <!-- start modal 1 -->
            
                                    <!-- The Modal -->
                                    <div class="modal" id="add_training_session">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">CES Trainings - ADD Module</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="container-fuild m-3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label ml-2 mb-0">Session title</label>
                                                                <input type="text" id="" name="" class="form-control mb-3"  value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <label class="form-label ml-2 mb-0">Category</label>
                                                                <select name="" class="form-control mb-3">
                                                                    <option value="" class="">Please Select Category</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1 mt-4">
                                                                <button class="form-control text-white bg-primary">...</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <label class="form-label ml-2 mb-0">Field of Specialization</label>
                                                                <select name="" class="form-control mb-3">
                                                                    <option value="" class="">Please Select Field of Specialization</option>
                                                                </select>                                                           
                                                            </div>
                                                            <div class="col-md-1 mt-4">
                                                                <button class="form-control text-white bg-primary">...</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Date From:</label>
                                                                <input type="date" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">To</label>
                                                                <input type="date" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <label class="form-label ml-2 mb-0">Vanue</label>
                                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-1 mt-4">
                                                                <button class="form-control text-white bg-primary">...</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-label ml-2 mb-0">No. of Hours:</label>
                                                                <input type="number" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="form-label ml-2 mb-0">Bario</label>
                                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <label class="form-label ml-2 mb-0">Resource Speaker</label>
                                                                <select name="" class="form-control mb-3">
                                                                    <option value="" class="">Please Select Resource Speaker</option>
                                                                </select>                                                           
                                                            </div>
                                                            <div class="col-md-1 mt-4">
                                                                <button class="form-control text-white bg-primary">...</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <label class="form-label ml-2 mb-0">Session Director</label>
                                                                <select name="" class="form-control mb-3">
                                                                    <option value="" class="">Please Select Session Director</option>
                                                                </select>                                                           
                                                            </div>
                                                            <div class="col-md-1 mt-4">
                                                                <button class="form-control text-white bg-primary">...</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label ml-2 mb-0">Status</label>
                                                                <select name="" class="form-control mb-3">
                                                                    <option value="" class="">Please Select Status</option>
                                                                </select>                                                           
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label ml-2 mb-0">Remarks</label>
                                                                <textarea name="" id="" cols="30" rows="3" class="form-control mb-3" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success">Add Module</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- end modal 1 -->
                                </div>
                                <div class="container-fluid col-md-8">
                                    <div class="bg-danger">
                                        <h4 class="pl-3 py-2 text-white font-weight-bold">RECORDS</h4>
                                    </div>
                                    <div class="border border-secondary">
                                        <div class="overflow-auto h-75">
                                            <table class="table table-responsive-lg table-hover">
                                                <thead class="text-white bg-secondary bg-gardient">
                                                    <tr>
                                                        <th scope="col">CESNO</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">CES Status</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">No. of Hourse</th>
                                                        <th scope="col"> Payment</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="">
                                                    <tr>
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
                                    </div>
                                    <!-- start modal 1 -->
                                    <div class="">
                                        <button type="button" class="btn btn-success col" data-bs-toggle="modal" data-bs-target="#add_participants">
                                            Add Participants
                                        </button>
                                    </div>
                                    <!-- The Modal -->
                                    <div class="modal" id="add_participants">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Participants</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="container-fuild m-3">
                                                        <div class="bg-danger">
                                                            <h4 class="pl-3 py-2 text-white font-weight-bold">BAGONG TAON, MGA BAGONG HAMON. CESO'T ELIGIBLES, PAANO KA TUTUGON?</h4>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label ml-2 mb-0">Name</label>
                                                                <select name="" class="form-control">
                                                                    <option value="" class="">Please Select Name</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label ml-2 mb-0">Mailing Address</label>
                                                                <textarea name="" id="" cols="30" rows="3" class="form-control" ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Office Tel. No. (Landline)</label>
                                                                <input type="number" id="" name="" class="form-control mb-3" placeholder="format: +63 (area code) + ####-####)" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Office Mobile. Number 1.</label>
                                                                <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Official Email Address </label>
                                                                <input type="number" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Office Mobile. Number 2.</label>
                                                                <input type="number" id="" name="" class="form-control mb-3" placeholder="format: ###-#######, ex. 945- 1234567)" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <label class="form-label ml-2 mb-0">Status</label>
                                                                <select name="" class="form-control">
                                                                    <option value="" class="">Please Select Status</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-label ml-2 mb-0">Payment</label>
                                                                <select name="" class="form-control">
                                                                    <option value="" class="">Please Select Payment</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label ml-2 mb-0">No. of Hours</label>
                                                                <input type="number" id="" name="" class="form-control mb-3" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label ml-2 mb-0">Remarks</label>
                                                                <textarea name="" id="" cols="30" rows="4" class="form-control" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success">Add Participant</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- end modal 1 -->
                                </div>
                            </div>
                            <!-- end CES TRAINING SESSIONS -->
                        </div>
                        <!-- Training Library -->
                        <div class="tab-pane fade" id="training_type_library" role="tabpanel" aria-labelledby="training_type_library-tab"> 
                            <div class="row"> 
                                <div class="col-md-3">
                                    <summary class="card m-1">
                                        <div class="card-header bg-white">
                                            <div class="card-body">
                                                <h3 class="card-title">Training Library</h3>
                                                <table>
                                                    <a class="tablinks" onclick="libTabs(event, 'TrainingLibrary')"href="#TrainingLibrary">&#187; Training Type Library</a></br>
                                                    <a class="tablinks" onclick="libTabs(event, 'FieldOfSpecialization')"href="#FieldOfSpecialization">&#187; Field of Specialization</a></br>
                                                    <a class="tablinks" onclick="libTabs(event, 'TrainingSecretariat')"href="#TrainingSecretariat">&#187; Training Secretariat</a></br>
                                                </table>
                                            </div>
                                        </div>
                                    </summary>
                                </div>
                                <!-- training library start -->
                                <div class="col-md-9">      
                                    <!-- training type library start -->                      
                                    <div id="TrainingLibrary" class="collapse tabcontent"  data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="card-body bg-white">
                                                <div>
                                                    <h1 id="page-title-h" class="h5 text-gray-900 m-0">Training Category Library</h1>
                                                    <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of All Training Category Library...</p>
                                                </div>
                                                <div>
                                                    <table class="table table-striped display-6 my-3">
                                                        <thead>
                                                            <td>Ctrl. No.</td>
                                                            <td>Description</td>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($Degree as $item)
                                                            <tr>
                                                                <td>{{ $item->CODE }}</td>
                                                                <td>{{ $item->DEGREE }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- start modal training type library -->
                                                <div class="container mt-3">
                                                    <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#training_type_library_modal">
                                                        Add Record
                                                    </button>
                                                </div><br/><br/>
                                                <!-- The Modal -->
                                                <form class="user" id="degreeID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/degree/add', 'degreeID', `Add`, `None`, `None`, `Yes`, `None` )">
                                                    @csrf
                                                    <div class="modal" id="training_type_library_modal">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Training Category - ADD Module</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label ml-2 mb-0">Training Category</label>
                                                                            <input type="text" name="" class="form-control w-100 mb-3" required>
                                                                        </div> 
                                                                    </div>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <div class="row ml-5 mt-3 mb-4">
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                                                        </div> 
                                                                    </div>
                                                                </div> 
                                                            </div>             
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- end modal training type library -->
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- training type library end -->
                                    <!-- Field of Specialization start -->                    
                                    <div id="FieldOfSpecialization" class="collapse tabcontent"  data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="card-body bg-white">
                                                <div>
                                                    <h1 id="page-title-h" class="h5 text-gray-900 m-0">Field of Specialization</h1>
                                                    <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of All Field of Specialization...</p>
                                                </div>
                                                <div>
                                                    <table class="table table-striped display-6 my-3">
                                                        <thead>
                                                            <td>Ctrl. No.</td>
                                                            <td>Description</td>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($Degree as $item)
                                                            <tr>
                                                                <td>{{ $item->CODE }}</td>
                                                                <td>{{ $item->DEGREE }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- start modal Field of Specialization -->
                                                <div class="container mt-3">
                                                    <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#field_onf_specialization_modal">
                                                        Add Record
                                                    </button>
                                                </div><br/><br/>
                                                <!-- The Modal -->
                                                <form class="user" id="degreeID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/degree/add', 'degreeID', `Add`, `None`, `None`, `Yes`, `None` )">
                                                    @csrf
                                                    <div class="modal" id="field_onf_specialization_modal">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Field of Specialization - ADD Module</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label ml-2 mb-0">Field of Specialization</label>
                                                                            <input type="text" name="" class="form-control w-100 mb-3" required>
                                                                        </div> 
                                                                    </div>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <div class="row ml-5 mt-3 mb-4">
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                                                        </div> 
                                                                    </div>
                                                                </div> 
                                                            </div>             
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- end modal Field of Specialization -->
                                            </div>
                                        </div>
                                    </div>                           
                                <!-- Field of Specialization end -->  
                                <!-- Training Secretariat start -->                    
                                <div id="TrainingSecretariat" class="collapse tabcontent"  data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="card-body bg-white">
                                                <div>
                                                    <h1 id="page-title-h" class="h5 text-gray-900 m-0">Training Secretariat</h1>
                                                    <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of All Training Secretariat...</p>
                                                </div>
                                                <div>
                                                    <table class="table table-striped display-6 my-3">
                                                        <thead>
                                                            <td>Ctrl. No.</td>
                                                            <td>Description</td>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($Degree as $item)
                                                            <tr>
                                                                <td>{{ $item->CODE }}</td>
                                                                <td>{{ $item->DEGREE }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- start Training Secretariat modal -->
                                                <div class="container mt-3">
                                                    <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#training_secretariat_modal">
                                                        Add Record
                                                    </button>
                                                </div><br/><br/>
                                                <!-- The Modal -->
                                                <form class="user" id="degreeID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/degree/add', 'degreeID', `Add`, `None`, `None`, `Yes`, `None` )">
                                                    @csrf
                                                    <div class="modal" id="training_secretariat_modal">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Training Secretariat - ADD Module</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label ml-2 mb-0">Training Secretariat</label>
                                                                            <input type="text" name="" class="form-control w-100 mb-3" required>
                                                                        </div> 
                                                                    </div>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <div class="row ml-5 mt-3 mb-4">
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                                                        </div>
                                                                        <div class="p-1">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                                                        </div> 
                                                                    </div>
                                                                </div> 
                                                            </div>             
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- end modal Training Secretariat -->
                                            </div>
                                        </div>
                                    </div>                           
                                <!-- Training Secretariat end -->                          
                                </div>
                            </div>
                        </div>
                        <!-- end Training Library -->
                        <!-- start TRAINING VENUE MANAGER -->
                        <div class="tab-pane fade" id="training_venue_manager" role="tabpanel" aria-labelledby="training_venue_manager-tab">  
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">TRAINING VENUE MANAGER</h4>
                            </div>
                            <div class="overflow-auto">
                                <table class="table table-responsive-lg table-hover">
                                    <thead class="text-white bg-secondary bg-gardient">
                                        <tr>
                                            <th scope="col">Ctrlno</th>
                                            <th scope="col">Venue Name</th>
                                            <th scope="col">City/Municipality</th>

                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Venue Name</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label  mr-0 mb-0">Bldg./No./Street</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Barangay</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">City/Municipality</label>
                                            <select name="" class="form-control w-100 mb-3">
                                                <option value="" class="col"></option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label ml-2 mb-0">Zip Code</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Contact No.</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">EmailAdd</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Contact Person</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="float-right row ml-5 mt-3 mb-4">
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-secondary" value="Update" >
                                        </div>
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                        </div>
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                        </div>
                                        <div class="p-1">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end TRAINING VENUE MANAGER -->
                        <!-- start TRAINING PROVIDER MANAGER -->
                        <div class="tab-pane fade" id="training_provider_manager" role="tabpanel" aria-labelledby="training_provider_manager-tab">  
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">TRAINING PROVIDER MANAGER</h4>
                            </div>
                            <div class="row container-fluid">
                                <div class="col-md-6">
                                    <form class="d-flex">
                                        <input class="form-control me-2 col-md-12" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn bg-primary btn-outline-primary text-white" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div style="height:300px;" class="overflow-auto bg-white">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-white bg-secondary bg-gardient">
                                                <tr>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
                                                <tr>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fuild m-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label ml-2 mb-0">Training Provider</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label  mr-0 mb-0">Address Bldg.</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label  mr-0 mb-0">No./Street</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>                                  
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">City/Province</label>
                                        <select name="" class="form-control w-100 mb-3">
                                            <option value="" class="col"></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                            <label class="form-label ml-2 mb-0">Zip Code</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    <div class="col-md-4">
                                        <label class="form-label ml-2 mb-0">Contact No.</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">EmailAdd</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Contact Person</label>
                                        <input type="text" id="" name="" class="form-control mb-3" value="">
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-secondary" value="Update" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                    </div>
                                    <div class="p-1">
                                        <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                    </div>
                                    <div class="p-1">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <!-- end TRAINING PROVIDER MANAGER -->
                        <!-- start RESOURCE PERSON MANAGER -->
                        <div class="tab-pane fade" id="resource_speakers_persons_manager" role="tabpanel" aria-labelledby="resource_speakers_persons_manager-tab">  
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">RESOURCE SPEAKER TABLE</h4>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div style="height:300px;" class="overflow-auto bg-white">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-white bg-secondary bg-gardient">
                                                <tr>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Middle Name</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Office / Company</th>
                                                    <th scope="col">Floor / Bldg.</th>
                                                    <th scope="col">No. / Street</th>
                                                    <th scope="col">Brgy. / District</th>
                                                    <th scope="col">City / Municipality</th>
                                                    <th scope="col">Zip Code</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Field of Expertise / Specialization</th>
                                                    <th scope="col">Contact No.</th>
                                                    <th scope="col">E-mail Address</th>
                                                    <th scope="col">From</th>
                                                    <th scope="col">To</th>
                                                    <th scope="col">Session Title</th>
                                                    <th scope="col"> Category</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row container-fluid">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Last Name</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label  mr-0 mb-0">First Name</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label  mr-0 mb-0">First Name</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>                                  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Position</label>
                                            <select name="" class="form-control w-100 mb-3">
                                                <option value="" class="col"></option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                                <label class="form-label ml-2 mb-0">Department</label>
                                                <input type="text" id="" name="" class="form-control mb-3" value="">
                                            </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Office / Company</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Floor / Bldg.</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">City Municipality</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Zip Code </label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Birthdate</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Field of Expertise / Specialization</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Contact No.</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">E-mail Address</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Date From:</label>
                                            <input type="date" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">To</label>
                                            <input type="date" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Session Title</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Category</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Inclusive Date</label>
                                            <input type="text" id="" name="" class="form-control mb-3" value="">
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-secondary" value="Update" >
                                        </div>
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-success" value="Save" >
                                        </div>
                                        <div class="p-1">
                                            <input onclick="" type="submit" class="btn btn-danger" value="Delete" >
                                        </div>
                                        <div class="p-1">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button> 
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="overflow-auto bg-white">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-white bg-secondary bg-gardient">
                                                <tr>
                                                    <th scope="col">SID</th>
                                                    <th scope="col">Session Title</th>
                                                    <th scope="col">Category</th>
                                                </tr>
                                            </thead>
                                            <tbody id="">
                                                <tr>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end RESOURCE PERSON MANAGER -->
                    </div>
                </div>
    </section>     
@endsection
