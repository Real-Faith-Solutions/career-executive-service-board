@extends('layout')

@section('content')
    <script>setPageTitle('201 Library Utility');</script>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3">
                        <summary class="card">
                        <div class="card-header bg-white">
                            <div class="card-body">
                                <h3 class="card-title">Library Category</h3>
                                <p class="card-text">List of all categories in 201 Library...</p>
                                <table>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#Address">&#187; Address</p>
                                        <div id="Address" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'AddressRecords')"href="#AddressRecords">&#187; City/Municipality</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#Education">&#187; Education</p>
                                        <div id="Education" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'DegreeRecords')"href="#DegreeRecords">&#187; Degree</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'CourseMajorRecords')"href="#CourseMajorRecords">&#187; Course Major</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'SchoolRecords')"href="#SchoolRecords">&#187; School</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#Examination">&#187; Examination</p>
                                        <div id="Examination" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'ExaminationRecords')"href="#ExaminationRecords">&#187; Examination Reference</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#LanguageDialect">&#187; Language/Dialect</p>
                                        <div id="LanguageDialect" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'LanguageDialectRecords')"href="#LanguageDialectRecords">&#187; Language/Dialects</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#CesStatus">&#187; Ces Status</p>
                                        <div id="CesStatus" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'CesStatusRefRecords')"href="#CesStatusRefRecords">&#187; Ces Status Ref</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'AcquiredThruRecords')"href="#AcquiredThruRecords">&#187; Acquired Thru</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'StatusTypeRecords')"href="#StatusTypeRecords">&#187; Status Type</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'AppointingAuthorityRecords')"href="#AppointingAuthorityRecords">&#187; Appointing Authority</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#Expertise">&#187; Expertise</p>
                                        <div id="Expertise" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'ExpertiseRecords')"href="#ExpertiseRecords">&#187; Expertise Records</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#CaseRecords">&#187; Case Records</p>
                                        <div id="CaseRecords" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'CaseNatureRecords')"href="#CaseNatureRecords">&#187; Case Nature</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'CaseStatusRecords')"href="#CaseStatusRecords">&#187; Case Status</a></br>
                                        </div>
                                    <p class="m-2 p-2 rounded bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#Location">&#187; Location</p>
                                        <div id="Location" class="collapse rounded pl-4 show active" role="presentation">
                                            <a class="tablinks" onclick="libTabs(event, 'CityRecords')"href="#CityRecords">&#187; City</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'ProvinceRecords')"href="#ProvinceRecords">&#187; Province</a></br>
                                            <a class="tablinks" onclick="libTabs(event, 'RegionRecords')"href="#RegionRecords">&#187; Region</a></br>
                                        </div>
                            </table>
                            </div>
                        </div>
                        </summary>
                    </div>
                        <!-- col md 8 start -->
                        <div class="card col-md-9">
                            <!-- Address records -->
                            <div id="AddressRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="card-body bg-white">
                                        <div>
                                            <h1 id="page-title-h" class="h5 text-gray-900 m-0">City / Municipality Library</h1>
                                            <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">City and Municipality Address Records...</p>
                                        </div>
                                        <!-- start city / municipality modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn-success float-right" data-bs-toggle="modal" data-bs-target="#city_municipality_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="city_municipality" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/city-municipality/add', 'city_municipality', `Add`, `None`, `None`, `city_municipality_submit`, `Yes`, `None`)">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="city_municipality_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add City / Municipality</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Description</label>
                                                                    <input type="text" name="NAME" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Zipcode</label>
                                                                    <input type="text" name="ZIPCODE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input id="city_municipality_submit" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end modal city / municipality -->
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl No.</td>
                                                <td>Description</td>
                                                <td>Zipcode</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($CityMunicipality as $item)
                                                <tr>
                                                    <td>{{ $item->CODE }}</td>
                                                    <td>{{ $item->NAME }}</td>
                                                    <td>{{ $item->ZIPCODE }}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                        <!-- end Address records -->
                    
                        <!-- Degree records -->
                        <div id="DegreeRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Education - Degree Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">Education - Degree Library Records...</p>
                                    </div>
                                    <!-- start degree -->
                                    <div class="container mt-3">
                                        <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#degree_modal">
                                            Add Record
                                        </button>
                                    </div><br/><br/>
                                    <!-- The Modal -->
                                    <form class="user" id="degreeID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/degree/add', 'degreeID', `Add`, `None`, `None`, `degreeID_submit`, `Yes`, `None`)">
                                        @csrf
                                        <div class="modal" id="degree_modal">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add Degree Records</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label ml-2 mb-0">Description</label>
                                                                <input type="text" name="DEGREE" class="form-control w-100 mb-3" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <div class="row ml-5 mt-3 mb-4">
                                                            <div class="p-1">
                                                                <input id="degreeID_submit" type="submit" class="btn btn-success" value="Add Record" >
                                                            </div>
                                                            <div class="p-1">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                </div>             
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end modal degree -->
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
                                </div>
                            </div>
                        </div>
                        <!-- end degree records -->
                        <!-- Course Major records -->
                        <div id="CourseMajorRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Education - Course Major Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">Education - Course Major Library Records...</p>
                                    </div>

                                    <!-- start Course Major - Education modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#course_major_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="course_majorID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/course-major/add', 'course_majorID', `Add`, `None`, `None`, `course_majorID_submit`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="course_major_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Course Major - Education</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Description</label>
                                                                    <input type="text" name="COURSE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input id="course_majorID_submit" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end modal Course Major - Education -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Description</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($CourseMajor as $item)
                                                <tr>
                                                    <td>{{ $item->CODE }}</td>
                                                    <td>{{ $item->COURSE }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Course Major records -->
                        <!-- School records -->
                        <div id="SchoolRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Education - School Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">Education - School Library Records...</p>
                                    </div>

                                        <!-- start School - Education modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#school_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="schoolID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/school/add', 'schoolID', `Add`, `None`, `None`, `schoolID_submit`, `Yes`, `None`)">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="school_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add School - Education</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Description</label>
                                                                    <input type="text" name="SCHOOL" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input id="schoolID_submit" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end modal School - Education -->

                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Description</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($School as $item)
                                                <tr>
                                                    <td>{{ $item->CODE }}</td>
                                                    <td>{{ $item->SCHOOL }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end School records -->
                        <!-- Examination -->
                        <div id="ExaminationRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Examination - Reference Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Examinations - Reference Records...</p>
                                    </div>

                                    <!-- start Examination Reference modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#examination_referance_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="examinationID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/examination-reference/add', 'examinationID', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="examination_referance_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Examination Reference</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="CODE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Examination Reference</label>
                                                                    <input type="text" name="TITLE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end modal Examination Reference -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Examination References</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($ExaminationReference as $item)
                                                <tr>
                                                    <td>{{ $item->CODE }}</td>
                                                    <td>{{ $item->TITLE }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Examination -->
                        <!-- Language/dialect -->
                        <div id="LanguageDialectRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Language / Dialect - Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Language / dialects Records...</p>
                                    </div>

                                    <!-- start Language/Dialects modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#languages_dialects">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="languageDialects" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/language-dialects/add', 'languageDialects', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="languages_dialects">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Language/Dialects</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Language/Dialects</label>
                                                                    <input type="text" name="title" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Language/Dialects -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Values</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($LanguageDialects as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->title }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Language/dialect -->
                        <!-- Ces Status Ref-->
                        <div id="CesStatusRefRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Ces Status Reference Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Ces Status Reference Records...</p>
                                    </div>
                                    <!-- start CES Status Reference modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#ces_status_ref">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="cesStatusRef" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/ces-status-reference/add', 'cesStatusRef', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="ces_status_ref">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add CES Status Reference</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">CES Status Reference</label>
                                                                    <input type="text" name="title" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal CES Status Reference -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Ces Status</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($CesStatusReference as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Ces Status Ref-->
                        <!-- Acquired Thru-->
                        <div id="AcquiredThruRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Ces Status - Acquisition Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Acquisition Records...</p>
                                    </div>

                                    <!-- start Acquired Thru modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#acquired_thru_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="acquired_thru" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/acquired-thru/add', 'acquired_thru', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="acquired_thru_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Acquired Thru</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Acquired Thru</label>
                                                                    <input type="text" name="description" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Acquired Thru -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Ces Status</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($AcquiredThru as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Acquired Thru-->
                        <!-- Status Type-->
                        <div id="StatusTypeRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Ces Status - Status Type Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Ces Status Type Records...</p>
                                    </div>

                                    <!-- start Status Type modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#ces_status_type_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="ces_status_type" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/ces-status-type/add', 'ces_status_type', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="ces_status_type_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add CES Status Type</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">CES Status Type</label>
                                                                    <input type="text" name="description" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Status Type -->

                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Ces Status Type</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($StatusType as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Status Type-->
                        <!-- Apointing Authority-->
                        <div id="AppointingAuthorityRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Ces Status - Apointing Authority Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Ces Apointing Authority Records...</p>
                                    </div>
                                    <!-- start Appointing Authority modal -->
                                        <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#appointing_authority_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="appointing_authority" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/appointing-authority/add', 'appointing_authority', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="appointing_authority_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add CES Appointing Authority</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">CES Appointing Authority</label>
                                                                    <input type="text" name="description" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Appointing Authority -->

                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Ces Appointing Authority</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($AppointingAuthority as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Apointing Authority-->
                        <!-- Expertise -->
                        <div id="ExpertiseRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 id="page-title-h" class="h5 text-gray-900 m-0">Category List</h1>
                                            <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Category Records...</p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                            <div class="card col-md-4 m-2">
                                                <form class="user" id="expertise_category" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/expertise-category/add', 'expertise_category', `Add`, `None`, `None`, `Yes`, `None` )">
                                                    @csrf
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mt-3">
                                                            <label class="form-label ml-2 mb-0">Expertise ID</label>
                                                            <input type="text" name="GenExp_Code" class="form-control w-100 mb-1" required>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="form-label ml-2 mb-0">Category Description</label>
                                                            <input type="text" name="Title" class="form-control w-100 mb-1" required>
                                                            <input onclick="" type="submit" class="btn btn-success float-right" value="Add Category" >
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <div class="card col-md-7 m-2"> 
                                            <div class="container-fluid h-50 m-2 mb-4 overflow-auto">
                                                <table class="table table-striped display-6 my-3">
                                                    <thead>
                                                        <td>Code</td>
                                                        <td>Category Title</td>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($ExpertiseCategory as $item)
                                                        <tr>
                                                            <td>{{ $item->GenExp_Code }}</td>
                                                            <td>{{ $item->Title }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input onclick="" class="btn btn-danger mb-2" value="Delete Category" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 id="page-title-h" class="h5 text-gray-900 m-0">Special Skill</h1>
                                            <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Category Records...</p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                            <div class="card col-md-4 m-2">
                                                <form class="user" id="special_skill" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/special-skill/add', 'special_skill', `Add`, `None`, `None`, `Yes`, `None` )">
                                                    @csrf
                                                    <div class="row mb-2">
                                                        <div class="col-sm-10 mt-3">
                                                            <label class="form-label ml-2 mb-0">Expertise Category</label>
                                                            <select class="form-select form-control mb-2" aria-label="Default select example">
                                                                <option selected>Select category</option>
                                                                @foreach ($ExpertiseCategory as $item)
                                                                    <option value="{{ $item->Title }}">{{ $item->Title }}</option>
                                                                @endforeach
                                                            </select>
                                                                                                                    </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label ml-2 mb-0">Special Skill ID</label>
                                                            <input type="text" name="SpeExp_Code" class="form-control w-100 mb-1" required>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="form-label ml-2 mb-0">Category Description</label>
                                                            <input type="text" name="Title" class="form-control w-100 mb-1" required>
                                                            <input onclick="" type="submit" class="btn btn-success float-right" value="Add Skill" >
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <div class="card col-md-7 m-2"> 
                                            <div class="container-fluid h-50 m-2 mb-4 overflow-auto">
                                                <table class="table table-striped display-6 my-3">
                                                    <thead>
                                                        <td>Code</td>
                                                        <td>Skill Description</td>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($SpecialSkill as $item)
                                                        <tr>
                                                            <td>{{ $item->SpeExp_Code }}</td>
                                                            <td>{{ $item->Title }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input onclick="" class="btn btn-danger mb-2" value="Delete Category" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Expertise -->
                        <!-- Case Nature -->
                        <div id="CaseNatureRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Case Nature Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Case Nature Records...</p>
                                    </div>
                                    <!-- start Case nature modal -->
                                    <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#case_nature_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="case_nature" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/case-nature/add', 'case_nature', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="case_nature_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Case nature</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="STATUS_CODE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Case nature</label>
                                                                    <input type="text" name="TITLE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Case nature -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Case Nature</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($CaseNature as $item)
                                                <tr>
                                                    <td>{{ $item->STATUS_CODE }}</td>
                                                    <td>{{ $item->TITLE }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Case Nature -->
                        <!-- Case Status -->
                        <div id="CaseStatusRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Case Status Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Case Status Records...</p>
                                    </div>
                                    <!-- start Case Status modal -->
                                    <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#case_status_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="case_status" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/case-status/add', 'case_status', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="case_status_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Case Status</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="STATUS_CODE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Case Status</label>
                                                                    <input type="text" name="TITLE" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Case Status -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Case Nature</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($CaseStatus as $item)
                                                <tr>
                                                    <td>{{ $item->STATUS_CODE }}</td>
                                                    <td>{{ $item->TITLE }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Case Status -->
                        <!-- Location - City -->
                        <div id="CityRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Location - City Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Location - City Records...</p>
                                    </div>
                                    <!-- start Location - City modal -->
                                    <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#city_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="cityID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/location-city/add', 'cityID', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="city_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Location - City</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Ctrl No.</label>
                                                                    <input type="text" name="city_code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Prov Ctrl No.</label>
                                                                    <input type="text" name="prov_code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">City</label>
                                                                    <input type="text" name="name" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Zip Code</label>
                                                                    <input type="text" name="zipcode" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Location - City -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Ctrl. No.</td>
                                                <td>Prov Ctrl No.</td>
                                                <td>City</td>
                                                <td>Zipcode</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($LocationCity as $item)
                                                <tr>
                                                    <td>{{ $item->city_code }}</td>
                                                    <td>{{ $item->prov_code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->zipcode }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Location - City -->
                        <!-- Location - Province -->
                        <div id="ProvinceRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Location - Province Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Location - Province Records...</p>
                                    </div>
                                    <!-- start Location - Province modal -->
                                    <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#province_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="provinceID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/location-province/add', 'provinceID', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="province_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Location - Province</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Prov Ctrl No.</label>
                                                                    <input type="text" name="prov_code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Reg Ctrl No.</label>
                                                                    <input type="text" name="reg_code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">City</label>
                                                                    <input type="text" name="name" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Zip Code</label>
                                                                    <input type="text" name="zipcode" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Location - Province -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Prov Ctrl No.</td>
                                                <td>Reg Ctrl No.</td>
                                                <td>City</td>
                                                <td>Zipcode</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($LocationProvince as $item)
                                                <tr>
                                                    <td>{{ $item->prov_code }}</td>
                                                    <td>{{ $item->reg_code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->zipcode }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Location - Province -->
                        <!-- Location Region -->
                        <div id="RegionRecords" class="collapse tabcontent"  data-bs-parent="#accordion">
                            <div class="panel-body">
                                <div class="card-body bg-white">
                                    <div>
                                        <h1 id="page-title-h" class="h5 text-gray-900 m-0">Location Region Library</h1>
                                        <p id="page-sub-title-h" class="font-size-7 font-weight-light text-gray-600 m-0 p-0">List of Location Region Records...</p>
                                    </div>
                                    <!-- start Location - Region modal -->
                                    <div class="container mt-3">
                                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#region_modal">
                                                Add Record
                                            </button>
                                        </div><br/><br/>
                                        <form class="user" id="regionID" method="POST" action="javascript:void(0);" onsubmit="submitForm('{{ env('APP_URL') }}admin/201-library/location-region/add', 'regionID', `Add`, `None`, `None`, `Yes`, `None` )">
                                            @csrf
                                            <!-- The Modal -->
                                            <div class="modal" id="region_modal">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Add Location - Region</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Reg Ctrl No.</label>
                                                                    <input type="text" name="reg_code" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Region</label>
                                                                    <input type="text" name="name" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Acronym</label>
                                                                    <input type="text" name="acronym" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Zip Code</label>
                                                                    <input type="text" name="zipcode" class="form-control w-100 mb-3" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label ml-2 mb-0">Region Seq.</label>
                                                                    <input type="text" name="regionSeq" class="form-control w-100 mb-3" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <div class="row ml-5 mt-3 mb-4">
                                                                <div class="p-1">
                                                                    <input onclick="" type="submit" class="btn btn-success" value="Add Record" >
                                                                </div>
                                                                <div class="p-1">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                    </div>             
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end modal Location - Region -->
                                    <div>
                                        <table class="table table-striped display-6 my-3">
                                            <thead>
                                                <td>Reg Ctrl No.</td>
                                                <td>Region</td>
                                                <td>Acronym</td>
                                                <td>Zipcode</td>
                                                <td>Region Seq.</td>
                                            </thead>
                                            <tbody>
                                                @foreach ($LocationRegion as $item)
                                                <tr>
                                                    <td>{{ $item->reg_code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->acronym }}</td>
                                                    <td>{{ $item->zipcode }}</td>
                                                    <td>{{ $item->regionSeq }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Location Region -->
                    </div>
                    <!-- col md 8 end -->
                </div>
            </div>
        </div>
    </div>
@endsection
