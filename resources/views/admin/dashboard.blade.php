@extends('layout')

@section('content')
<script>setPageTitle('CES Dashboard');</script>

<!-- Main content -->
<section class="content my-3">
    <div class="container-fluid" style="color: white;">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        @foreach ($data['items'] as $group)
            @foreach ($group['group_values'] as $item)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-left-{{ $item['color'] ?? 'success' }} shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-{{ $item['color'] ?? 'success' }} text-uppercase mb-1">
                                    {{ $item['label'] ?? '' }}</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($item['value']) ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas {{ $item['icon'] ?? '' }} fa-3x text-{{ $item['color'] ?? 'success' }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            @endforeach
        @endforeach
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<center class="m-5">
    <div>
      <h1 class="text-gray-800">Widgets & Reports</h1>
    </div>
</center>

<!-- CLIENT WIDGETS -->
<section class="content my-3">
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-12 col-md-6 col-xl-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{!! $data['charts']['by_profile_ces_status']['group_headers'] ?? '' !!}</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartProfileCESStatus"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-12 col-md-6 col-xl-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{!! $data['charts']['profile_status']['group_headers'] ?? '' !!}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="chartProfileAccStatus"></canvas>
                        </div>

                        <div class="mt-4 text-center small text-black">
                            @for($i = 0; $i < count($data['charts']['profile_status']['labels']); $i++)
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: {{ $data['charts']['profile_status']['colors'][$i] }};"></i> 
                                <b>{{ $data['charts']['profile_status']['labels'][$i] }}</b> ({{ number_format($data['charts']['profile_status']['values'][$i]) }})
                            </span>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>


            <!-- Pie Chart -->
            <div class="col-12 col-md-6 col-xl-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{!! $data['charts']['profile_gender']['group_headers'] ?? '' !!}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="chartProfileGender"></canvas>
                        </div>

                        <div class="mt-4 text-center small text-black">
                            @for($i = 0; $i < count($data['charts']['profile_gender']['labels']); $i++)
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: {{ $data['charts']['profile_gender']['colors'][$i] }};"></i> 
                                <b>{{ $data['charts']['profile_gender']['labels'][$i] }}</b> ({{ number_format($data['charts']['profile_gender']['values'][$i]) }})
                            </span>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <!-- Area Chart -->
            <div class="col-12 col-md-6 col-xl-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{!! $data['charts']['by_pwd_case']['group_headers'] ?? '' !!}</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartProfileTitle"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach ($data['items'] as $group)
@foreach ($group['group_values'] as $item)
@if($item['value'] != 0)

<script type="text/javascript">

    pieChart('chartProfileAccStatus', 
        {!! json_encode($data['charts']["profile_status"]['labels']) !!}, 
        {!! json_encode($data['charts']["profile_status"]['values']) !!}, 
        {!! json_encode($data['charts']["profile_status"]['colors']) !!}
    );
    pieChart('chartProfileGender', 
        {!! json_encode($data['charts']["profile_gender"]['labels']) !!}, 
        {!! json_encode($data['charts']["profile_gender"]['values']) !!}, 
        {!! json_encode($data['charts']["profile_gender"]['colors']) !!}
    );


    barChart('chartProfileCESStatus', 
        {!! json_encode($data['charts']['by_profile_ces_status_gender']['labels']) !!}, 
        {!! json_encode($data['charts']['by_profile_ces_status_gender']['values']) !!}, 
        {!! json_encode(($data['charts']['by_profile_ces_status_gender']['values'][0] ?? 0) + (($data['charts']['by_profile_ces_status_gender']['values'][0] ?? 0) * .10)) !!}, 
        ''
    );
    barChart('chartProfileTitle', 
        {!! json_encode($data['charts']['by_pwd_case']['labels']) !!}, 
        {!! json_encode($data['charts']['by_pwd_case']['values']) !!}, 
        {!! json_encode(($data['charts']['by_pwd_case']['values'][0] ?? 0) + (($data['charts']['by_pwd_case']['values'][0] ?? 0) * .10)) !!}, 
        ''
    );

    {{--

    barChart('chartEarnings', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep' , 'Oct', 'Nov', 'Dec'],
     ['52', '13', '35', '75', '64', '54', '82', '64', '14', '37', '97', '54'], 100, '');
    barChart('chartVolume', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep' , 'Oct', 'Nov', 'Dec'],
     ['20', '23', '40', '20', '23', '40', '20', '23', '40', '50', '63', '70'], 80, '');
    barChart('chartSMPCity', {!! json_encode($data['charts'][2]['labels']) !!}, {!! json_encode($data['charts'][2]['values']) !!}, {!! json_encode(($data['charts'][2]['values'][0] ?? 0) + 2) !!}, '');
    barChart('chartSMPParameter', {!! json_encode($data['charts'][3]['labels']) !!}, {!! json_encode($data['charts'][3]['values']) !!}, {!! json_encode(($data['charts'][3]['values'][0] ?? 0) + 2) !!}, '');
    barChart('chartSMPParameterCn', {!! json_encode($data['charts'][4]['labels']) !!}, {!! json_encode($data['charts'][4]['values']) !!}, {!! json_encode(($data['charts'][4]['values'][0] ?? 0) + 2) !!}, '');
    barChart('chartSMPHpcRemarksCity', {!! json_encode($data['charts'][5]['labels']) !!}, {!! json_encode($data['charts'][5]['values']) !!}, {!! json_encode(($data['charts'][5]['values'][0] ?? 0) + 2) !!}, '');
    barChart('chartSMPTcRemarksCity', {!! json_encode($data['charts'][6]['labels']) !!}, {!! json_encode($data['charts'][6]['values']) !!}, {!! json_encode(($data['charts'][6]['values'][0] ?? 0) + 2) !!}, '');
   
    --}}

</script>

@endif
@endforeach
@endforeach

@endsection
