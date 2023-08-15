@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="card bg-slate-50 lg:flex lg:justify-between text-slate-500 text-2xl">
        <h1>Hello {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
        <h1 id="currentDateTime"></h1>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESO }}</h1>
            <p>Total CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESOActive }}</h1>
            <p>Total Active CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESODeceased }}</h1>
            <p>Total Deceased CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESORetired }}</h1>
            <p>Total Retired CESOs</p>
        </div>
    </div>

@endsection
