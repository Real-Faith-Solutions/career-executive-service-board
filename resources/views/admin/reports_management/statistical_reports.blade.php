@extends('layout')

@section('content')
<script>setPageTitle('Statistical Reports - CES Reports');</script>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span class="card-title h6 font-weight-bold text-primary">List of Profiles by Age</span>
                        <!--<button class="btn btn-success btn-xs" style="margin-left: 77%" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>-->
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive" style="max-height: 600px;">
                        <table id="generalTable" class="table table-borderless table-striped table-sm" style="border-radius: 3px; overflow: hidden;">
                        <thead class="thead-dark">
                            <tr>
                            <th>Record Group</th>
                            <th>Total Counts</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-light">
                            @foreach($recordByAge as $record)
                            <tr class="mx-md-n5">
                                <td>{{$record[0] ?? 0}}</td>
                                <td>{{number_format($record[1] ?? 0)}}</td>
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

<br/><br/>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span class="card-title h6 font-weight-bold text-primary">List of Profiles Status</span>
                        <!--<button class="btn btn-success btn-xs" style="margin-left: 77%" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>-->
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive" style="max-height: 600px;">
                        <table id="generalTable2" class="table table-borderless table-striped table-sm" style="border-radius: 3px; overflow: hidden;">
                        <thead class="thead-dark">
                            <tr>
                            <th>Record Group</th>
                            <th>Total Counts</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-light">
                            @foreach($recordByPosition as $record)
                            <tr class="mx-md-n5">
                                <td>{{$record[0] ?? 0}}</td>
                                <td>{{number_format($record[1] ?? 0)}}</td>
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
