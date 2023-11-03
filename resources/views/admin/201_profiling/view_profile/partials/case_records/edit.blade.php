@extends('layouts.app')
@section('title', 'Case Records')
@section('sub', 'Case Records')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('case-record.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Case Record/s
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('case-record.update', ['ctrlno'=>$caseRecord->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="case_records_edit" onsubmit="return checkErrorsBeforeSubmit(case_records_edit)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="parties_edit">Parties<sup>*</sup></label>
                        <input type="text" id="parties_edit" name="parties" value="{{ $caseRecord->parties }}" oninput="validateInput(parties_edit, 2, 'alphaNumeric')" onkeypress="validateInput(parties_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(parties_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('parties')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="offense_edit">Offense<sup>*</sup></label>
                        <input type="text" id="offense_edit" name="offense" value="{{ $caseRecord->offence }}" oninput="validateInput(offense_edit, 2, 'alphaNumeric')" onkeypress="validateInput(offense_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(offense_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('offense')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nature_of_offense_edit">Nature of Offense<sup>*</sup></label>
                        <select id="nature_of_offense_edit" name="nature_of_offense" required>
                            @foreach ($profileLibTblCaseNature as $profileLibTblCaseNatures)
                                @if ($profileLibTblCaseNatures->STATUS_CODE == $caseRecord->nature_code)
                                    <option value="{{ $profileLibTblCaseNatures->STATUS_CODE }}" selected>
                                        {{ $profileLibTblCaseNatures->TITLE }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblCaseNatures->STATUS_CODE }}">
                                        {{ $profileLibTblCaseNatures->TITLE }}
                                    </option>
                                @endif
                           @endforeach
                        </select>
                        @error('nature_of_offense')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="case_number_edit">Case number<sup>*</sup></label>
                        <input type="text" id="case_number_edit" name="case_no" value="{{ $caseRecord->case_no }}" oninput="validateInput(case_number_edit, 2)" onkeypress="validateInput(case_number_edit, 2)" onblur="checkErrorMessage(case_number_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('case_no')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_filed_edit">Date Filed<sup>*</sup></label>
                        <input type="date" id="date_filed_edit" name="date_filed" value="{{ $dateFiled }}" oninput="validateDateInput(date_filed_edit), validateDateFromTo(date_filed_edit, date_finality_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_filed')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="venue_edit">Venue<sup>*</sup></label>
                        <input type="text" id="venue_edit" name="venue" value="{{ $caseRecord->venue }}" oninput="validateInput(venue_edit, 2)" onkeypress="validateInput(venue_edit, 2)" onblur="checkErrorMessage(venue_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="case_status_edit">Case Status<sup>*</sup></label>
                        <select id="case_status_edit" name="case_status" required>
                            <option disabled selected>Select Case Status</option>
                            @foreach ($profileLibTblCaseStatus as $profileLibTblCaseStatuses)
                                @if ($profileLibTblCaseStatuses->STATUS_CODE == $caseRecord->status_code )
                                    <option value="{{ $profileLibTblCaseStatuses->STATUS_CODE }}" selected>{{ $profileLibTblCaseStatuses->TITLE }}</option>
                                @else
                                    <option value="{{ $profileLibTblCaseStatuses->STATUS_CODE }}">{{ $profileLibTblCaseStatuses->TITLE }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('case_status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_finality_edit">Date of Finality<sup>*</sup></label>
                        <input type="date" id="date_finality_edit" name="date_finality" value="{{ $dateFinality }}" oninput="validateDateInput(date_finality_edit), validateDateFromTo(date_filed_edit, date_finality_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_finality')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="decision_edit">Decision<sup>*</sup></label>
                        <input type="text" id="decision_edit" name="decision" value="{{ $caseRecord->decision }}" oninput="validateInput(decision_edit, 2, 'alphaNumeric')" onkeypress="validateInput(decision_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(decision_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('decision')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks_edit">Remarks<sup>*</sup></label>
                        <input type="text" id="remarks_edit" name="remarks" value="{{ $caseRecord->remarks }}" oninput="validateInput(remarks_edit, 2, 'alphaNumeric')" onkeypress="validateInput(remarks_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(remarks_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateCaseRecordButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection