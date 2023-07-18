<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/branding.png') }}"/>
    <title>{{ env('APP_NAME') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome -->

    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/charts-components.js') }}"></script>

    <!-- jQuery -->
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>

    <!-- datepicker -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js'></script>

    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion @if (str_contains(Request::url(),'profile/view')) toggled @endif" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ config('app.url') }}admin/dashboard">
                <div class="sidebar-brand-icon">
                    <img src={{ asset('images/branding.png') }} style="height: 50px; width: 50px;" />
                </div>
                <div class="sidebar-brand-text">
                    <span>
                        {{ env('APP_NAME') }}
                    </span>
                </div>
            </a>

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Dashboard') == 'true')

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ config('app.url') }}admin/dashboard">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('201 Profiling') == 'true')

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>201 Profiling</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if(Auth::user()->role == 'User')

                        <a class="collapse-item" href="{{ env('APP_URL') }}admin/profile/views/{{ Auth::user()->cesno }}">View Profile</a>
                        @else
                        @if(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Personal Data','Add') == 'true')

                        <a class="collapse-item" href="{{ env('APP_URL') }}admin/profile/add">Add Profile</a>
                        @endif
                        @if(App\Http\Controllers\ProfileController::latestCesNo() != 1)

                        <a class="collapse-item" href="{{ env('APP_URL') }}admin/profile/view">View Profiles</a>
                        @endif
                        @endif

                    </div>
                </div>
            </li>
            @endif

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Plantilla') == 'true')

            <li class="nav-item">
                <a class="nav-link" href="{{ config('app.url') }}admin/online-ces-plantilla-management-system/view">
                    <i class="fas fa-fw fa-id-card-alt"></i>
                    <span>Plantilla</span>
                </a>
            </li>
            @endif

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Competency') == 'true')

            <li class="nav-item">
                <a class="nav-link" href="{{ config('app.url') }}admin/competency-management-system/view">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Competency</span>
                </a>
            </li>
            @endif

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Reports') == 'true')

            <!-- Nav Item - Reports Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
                    aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Executive 201 Profile:</h6>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/report/general-reports">General Reports</a>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/report/statistical-reports">Statistical Reports</a>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/report/sales">Reports for Placement</a>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/report/birthday-cards-reports">Report for <br/> Birthday Cards</a>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/report/sales">Data Portability Report</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            @endif

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true')

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rightsmanagemenet"
                    aria-expanded="true" aria-controls="rightsmanagemenet">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Rights Management</span>
                </a>
                <div id="rightsmanagemenet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ config('app.url') }}admin/rights-management/user">Users</a>
                        <a class="collapse-item" href="{{ config('app.url') }}admin/rights-management/roles">Roles</a>
                    </div>
                </div>
            </li>
            @endif

            @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('System Utility') == 'true')

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#systemutility"
                    aria-expanded="true" aria-controls="systemutility">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>System Utility</span>
                </a>
                <div id="systemutility" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ config('app.url') }}admin/201-library">201 Library</a>
                        @if(App\Http\Controllers\RolesController::validateUserCesWebAppGeneralPageAccess('Database Migration') == 'true')

                        <a class="collapse-item" href="{{ config('app.url') }}admin/system-utility/database-migration">Database Migration</a>
                        @endif

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            @endif

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <div>
                        <h1 id="page-title-h" class="h4 text-gray-900 m-0">{{-- Title will be set by "setPageTitle" js function --}}</h1>
                        <p id="page-sub-title-h" class="font-size-6 font-weight-light text-gray-600 m-0 ml-1 p-0">{{-- Title will be set by "setPageTitle" js function --}}</p>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="row-md">
                                    <span class="mr-2 d-none d-lg-inline text-gray-800 medium">{{ (Auth::user()->first_name ?? "").' '.(Auth::user()->last_name ?? "")}}</span>
                                    <hr class="m-0 p-0" />
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->role ?? ""}}</span>
                                </div>
                                <img class="img-profile rounded-circle" @if(Auth::user()->role == 'User') id="menu_profile_picture" src="{{ (Auth::user()->picture == '' ? asset('images/placeholder.png') : asset('external-storage/Photos/201 Photos/' . Auth::user()->picture)) }}" @else src="{{ (Auth::user()->picture == '' ? asset('images/placeholder.png') : asset('external-storage/Photos/Staff Photos/' . Auth::user()->picture)) }}" @endif  onerror="this.src = '{{ asset('images/placeholder.png') }}'">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ env('APP_URL') }}logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid p-3">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

                <footer class="main-footer p-3 text-center">
                    <strong><a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.</strong>
                    All rights reserved.
                </footer>
            </div>
        </div>
        <!-- ./wrapper -->

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Page level custom scripts -->
    <!--<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>-->
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @if (str_contains(Request::url(),'admin/system-utility/database-migration'))

    <script src="{{ asset('js/migration.js') }}"></script>
    @endif

    <script>changeRootURL('{{ env('APP_URL') }}');</script>

    <script>
        $(document).ready(function() {
            $('#generalTable, #generalTable2, #generalTable3, #generalTable4, #generalTable5, #generalTable6').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        attr:  {
                            title: 'Copy',
                            id: 'copyButton',
                            class: 'btn btn-primary btn-sm'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        attr:  {
                            title: 'PDF',
                            id: 'button',
                            class: 'btn btn-danger btn-sm'
                        }
                    }
                ],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            } );

            $('div.dataTables_filter input').addClass('px-2 mx-2');
            $('div.dataTables_filter input').attr('placeholder', 'Keyword here...');
        } );
    </script>
    </body>
</html>
