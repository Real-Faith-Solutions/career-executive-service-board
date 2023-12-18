@extends('layouts.app')
@section('title', 'Eligibility and Rank Tracker')
@section('sub', 'Eligibility and Rank Tracker')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('eligibility-rank-tracker.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Eligibility and Rank Tracker
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('eligibility-rank-tracker.store',['cesno'=>$cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="cesstat_code">CES Status<sup>*</sup></label>
                        <select id="cesstat_code" name="cesstat_code" required type="text">
                            <option disabled selected value="">Select CES Status</option>
                            @foreach ($profileLibTblCesStatus as $newProfileLibTblCesStatus)
                                <option value="{{ $newProfileLibTblCesStatus->code }}">{{ $newProfileLibTblCesStatus->description }}</option>
                            @endforeach
                        </select>
                        @error('cesstat_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="acc_code">Acquired Thru<sup>*</sup></label>
                        <select id="acc_code" name="acc_code" required type="text">
                            <option disabled selected value="">Select Acquired Thru</option>
                            @foreach ($profileLibTblCesStatusAcc as $newProfileLibTblCesStatusAcc)
                                <option value="{{ $newProfileLibTblCesStatusAcc->code }}">{{ $newProfileLibTblCesStatusAcc->description }}</option>
                            @endforeach
                        </select>
                        @error('acc_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="type_code">Status Type<sup>*</sup></label>
                        <select id="type_code" name="type_code" required type="text">
                            <option disabled selected value="">Select Status Type</option>
                            @foreach ($profileLibTblCesStatusType as $newProfileLibTblCesStatusType)
                                <option value="{{ $newProfileLibTblCesStatusType->code }}">{{ $newProfileLibTblCesStatusType->description }}</option>
                            @endforeach
                        </select>
                        @error('type_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="official_code">Appointing Authority<sup>*</sup></label>
                        <select id="official_code" name="official_code" required type="text">
                            <option disabled selected value="">Select Appointing Authority</option>
                            @foreach ($profileLibTblAppAuthority as $newProfileLibTblAppAuthority)
                                <option value="{{ $newProfileLibTblAppAuthority->code }}">{{ $newProfileLibTblAppAuthority->description }}</option>
                            @endforeach
                        </select>
                        @error('official_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="resolution_no">Resolution No<sup>*</sup></label>
                        <input id="resolution_no" name="resolution_no" required type="number">
                        @error('resolution_no')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="appointed_dt">Date Acquired<sup>*</sup></label>
                        <input id="appointed_dt" name="appointed_dt" oninput="validateDateInput(appointed_dt)" required type="date">
                        <p class="input_error text-red-600"></p>
                        @error('appointed_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div> 

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection