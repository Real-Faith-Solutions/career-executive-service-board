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
            Update Form Eligibility and Rank Tracker
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eligibility-rank-tracker.update', ['ctrlno'=>$profileTblCesStatus->ctrlno, 'cesno'=>$cesno]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="cesstat_code">CES Status<sup>*</sup></label>
                        <select id="cesstat_code" name="cesstat_code" required type="text">
                            <option disabled selected>Select CES Status</option>
                            @foreach ($profileLibTblCesStatus as $newProfileLibTblCesStatus)
                                @if ($newProfileLibTblCesStatus->code == $profileTblCesStatus->cesstat_code)
                                    <option value="{{ $newProfileLibTblCesStatus->code }}" selected>{{ $newProfileLibTblCesStatus->description }}</option>
                                @else
                                    <option value="{{ $newProfileLibTblCesStatus->code }}">{{ $newProfileLibTblCesStatus->description }}</option>
                                @endif
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
                            <option disabled selected>Select Acquired Thru</option>
                            @foreach ($profileLibTblCesStatusAcc as $newProfileLibTblCesStatusAcc) profileTblCesStatus
                                @if ( $newProfileLibTblCesStatusAcc->code == $profileTblCesStatus->acc_code)
                                    <option value="{{ $newProfileLibTblCesStatusAcc->code }}" selected>{{ $newProfileLibTblCesStatusAcc->description }}</option>
                                @else
                                    <option value="{{ $newProfileLibTblCesStatusAcc->code }}">{{ $newProfileLibTblCesStatusAcc->description }}</option>
                                @endif
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
                            <option disabled selected>Select Status Type</option>
                            @foreach ($profileLibTblCesStatusType as $newProfileLibTblCesStatusType)
                                @if ($newProfileLibTblCesStatusType->code == $profileTblCesStatus->type_code)
                                    <option value="{{ $newProfileLibTblCesStatusType->code }}" selected>{{ $newProfileLibTblCesStatusType->description }}</option>
                                @else
                                    <option value="{{ $newProfileLibTblCesStatusType->code }}">{{ $newProfileLibTblCesStatusType->description }}</option>
                                @endif
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
                            <option disabled selected>Select Appointing Authority</option>
                            @foreach ($profileLibTblAppAuthority as $newProfileLibTblAppAuthority)
                                @if ($newProfileLibTblAppAuthority->code == $profileTblCesStatus->official_code)
                                    <option value="{{ $newProfileLibTblAppAuthority->code }}" selected>{{ $newProfileLibTblAppAuthority->description }}</option>
                                @else
                                    <option value="{{ $newProfileLibTblAppAuthority->code }}">{{ $newProfileLibTblAppAuthority->description }}</option>
                                @endif
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
                        <input id="resolution_no" name="resolution_no" value="{{ $profileTblCesStatus->resolution_no }}" required type="number">
                        @error('resolution_no')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="appointed_dt">Date Acquired<sup>*</sup></label>
                        <input id="appointed_dt" name="appointed_dt" value="{{ $profileTblCesStatus->appointed_dt }}" required type="date">
                        @error('appointed_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div> 

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateEligibilityAndRankTrackerButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection