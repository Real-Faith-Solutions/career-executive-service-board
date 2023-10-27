@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@auth
<div class="card bg-slate-50 lg:flex lg:justify-between text-slate-500 text-2xl">
    <h1>Hello {{ $userTitle." ".$userName." [".$userRoleTitle."]" }}</h1>
    <h1 id="currentDateTime"></h1>
</div>
@endauth

@include('admin.dashboard.partials.ceso_status')

<div class="grid gap-4 mb-3 uppercase sm:grid-cols-1 sm:gap-3 lg:grid-cols-3 lg:gap-4">
    <div class="w-full rounded sm:w-auto">
        <div class="bg-white">
            <div class="rounded-lg shadow-md">
                <canvas class="w-full p-2" id="profileStatus"></canvas>
                <script>
                    profileStatus();
                </script>
            </div>
        </div>
    </div>
</div>

@endsection