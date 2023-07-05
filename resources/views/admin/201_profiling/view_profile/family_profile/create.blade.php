@extends('layouts.app')
@section('title', 'Family profile form')
@section('content')

<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Spouse Details</h1>
</div>

{{-- ["id" => $id, "token" => $token]  ['cesno' => $cesno->cesno]--}}

<form action="{{ route('family-profile.store', ['cesno' => $cesno]) }}" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="last_name" name="last_name" >
        </div>

        <div></div>

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" name="first_name" id="first_name">
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name<sup>*</span></label>
            <input type="text" name="middle_name" id="middle_name">
        </div>

        <div class="mb-3">
            <label for="suffix">Name Extension<sup>*</span></label>
            <input type="text" name="suffix" id="suffix">
        </div>

        <div class="mb-3">
            <label for="occupation">Occupation</label>
            <input type="text" name="occupation" id="occupation">
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_name">Employer/Bussiness Name</label>
            <input type="text" name="employer_bussiness_name" id="employer_bussiness_name">
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_address">Employer/Bussiness Address</label>
            <input type="text" name="employer_bussiness_address" id="employer_bussiness_address">
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_telephone">Employer/Bussiness Telephone No.</label>
            <input type="text" name="employer_bussiness_telephone" id="employer_bussiness_telephone">
        </div>

    </div>

    <div><button type="submit" class="btn btn-primary">Submit</button></div>
</form>
@endsection
