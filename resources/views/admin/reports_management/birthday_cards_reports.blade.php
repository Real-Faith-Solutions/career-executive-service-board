@extends('layout')

@section('content')
<script>setPageTitle('Birthday Cards Reports - CES Reports');</script>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span class="card-title h6 font-weight-bold text-primary">List of Birthday Cards Active Profiles</span>
                        <!--<button class="btn btn-success btn-xs" style="margin-left: 77%" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>-->
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive" style="max-height: 600px;">
                        <table id="generalTable" class="table table-borderless table-striped table-sm" style="border-radius: 3px; overflow: hidden;">
                        <thead class="thead-dark">
                            <tr>
                            <th>CES No.</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Birth Date</th>
                            <th>CES Status</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-light">
                            @foreach($birthMonthProfiles as $record)
                            <tr class="mx-md-n5">
                            <!-- <td>
                                <button class="viewLab collapse-item btn text-primary" data-bs-toggle="modal" data-bs-target="#addLabAcceptance" data-id="{{$record->test_no ?? 0}}">
                                <i class="bi bi-eye-fill"></i>
                                </button>
                            </td> -->

                            <td>{{$record->cesno ?? 0}}</td>
                            <td>{{$record->lastname ?? 0}}</td>
                            <td>{{$record->firstname ?? 0}}</td>
                            <td>{{$record->middlename ?? 0}}</td>
                            <td>{{date('M d, Y', strtotime($record->birthdate)) ?? 0}}</td>
                            <td>{{$record->cesstatusvalue->description ?? 0}}</td>
                            <td>{{$record->status ?? 0}}</td>

                            <!-- <td>
                                <span class="badge badge-{{$record->remarks == 'Accepted' ? 'success': '' }}{{$record->remarks == 'Conditionally Accepted' ? 'primary': '' }}{{$record->remarks == 'Rejected' ? 'danger': '' }}">
                                {{$record->remarks ?? 0}}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{$record->lab_acceptance_final_remarks   ? 'danger': '' }}">
                                {{$record->lab_acceptance_final_remarks ?? 0}}
                                </span>
                            </td> -->

                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection
