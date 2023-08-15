@extends('layouts.app')
@section('content')
    <div class="card bg-slate-100 flex justify-between text-slate-500 text-2xl">
    <h1>Hello {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
        <h1 id="currentDateTime"></h1>

    </div>
@endsection
