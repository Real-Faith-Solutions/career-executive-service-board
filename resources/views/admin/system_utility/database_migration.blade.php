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

        <script>setPageTitle('Migration System');</script>

        <div class="container-fluid border border-primary py-3 pt-3">
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="migration_system_tab" data-bs-toggle="tab" href="#migration_system" role="tab" aria-controls="migration_system" aria-selected="true">Database Migration</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border border-primary">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Migration System -->
                        <div class="tab-pane fade show active" id="migration_system" role="tabpanel" aria-labelledby="migration_system_tab">
                            <div class="bg-primary">
                                <h4 class="pl-3 py-2 text-warning font-weight-bold">DATABASE MIGRATION</h4>
                            </div>    
                            <div class="col mt-5 mb-5">
                                <div id="start_migration_button_div" class="row justify-content-center">
                                    @if(count($DatabaseMigrations) === 0)

                                    <button class="btn btn-primary mb-3" onclick="migrateDatabase()">Start Migration</button>
                                    @else

                                    <button class="btn btn-primary mb-3 mr-1" onclick="migrateDatabase('recheck')">Re-check Migration</button>
                                    <button class="btn btn-danger mb-3 ml-1" onclick="migrateDatabase('rerun')">Re-run Migration</button>
                                    @endif

                                </div>
                                @if(count($DatabaseMigrations) != 0)

                                <div id="migration_status_div" class="row justify-content-center">
                                    <div class="overflow-auto">
                                        <table class="table table-responsive-lg table-hover">
                                            <thead class="text-white bg-secondary bg-gardient">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Updated Category</th>
                                                    <th scope="col">Table Source</th>
                                                    <th scope="col">Start</th>
                                                    <th scope="col">Finish</th>
                                                    <th scope="col">Duration</th>
                                                    <th scope="col">Migration Status</th>
                                                    <th scope="col">Last Updated By</th>
                                                    <th scope="col">Last Update Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="DatabaseMigrations_tbody">
                                                @foreach($DatabaseMigrations as $item)

                                                <tr>
                                                    <td>@if($item->migration_status == 'Success')<i class="fas fa-check fa-sm fa-fw text-success"></i>@else<i class="fas fa-exclamation-triangle fa-sm fa-fw text-danger"></i>@endif</td>
                                                    <td nowrap="nowrap">{{ $item->updated_category }}</td>
                                                    <td nowrap="nowrap">
                                                    @foreach(explode(',',$item->table_source) as $table_source_item)
                                                        
                                                        @if(!empty($table_source_item))
                                                        <li>{{$table_source_item}}</li>
                                                        @endif
                                                    
                                                    @endforeach

                                                    </td>
                                                    <td style="text-align: center;" nowrap="nowrap">{{ strftime('%r', strtotime($item->start)) ?? '-' }}</td>
                                                    <td style="text-align: center;" nowrap="nowrap">{{ strftime('%r', strtotime($item->finish)) ?? '-' }}</td>
                                                    <td style="text-align: center;" nowrap="nowrap">{{ $item->duration_in_minutes }} min.</td>
                                                    <td style="text-align: center;">@if($item->migration_status == 'Success')<span class="badge badge-pill badge-success">Success</span>@else<span class="badge badge-pill badge-danger">Failed</span>@endif</td>
                                                    <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                    <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                        <!-- End Migration System -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
