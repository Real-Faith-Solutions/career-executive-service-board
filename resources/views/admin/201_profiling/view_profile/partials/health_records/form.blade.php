@extends('layouts.app')
@section('title', 'Health Records')
@section('sub', 'Health Records')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Health Record
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('health-record.store', ['cesno'=>$cesno]) }}" method="POST" id="health_record_form" onsubmit="return checkErrorsBeforeSubmit(health_record_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="blood_type">Blood Type<sup>*</sup></label>
                        <input type="text" id="blood_type" name="blood_type" value="{{ old('blood_type') ?? ($healthRecord->blood_type ?? '') }}" oninput="validateInput(blood_type, 1, 'lettersWithSpecial')" onkeypress="validateInput(blood_type, 1, 'lettersWithSpecial')" onblur="checkErrorMessage(blood_type)" required>
                        <p class="input_error text-red-600"></p>
                        @error('blood_type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="identifying_marks">Identifying Marks<sup>*</sup></label>
                        <input type="text" id="identifying_marks" name="identifying_marks" value="{{ old('marks') ?? ($healthRecord->marks ?? '') }}" oninput="validateInput(identifying_marks, 0, 'letters')" onkeypress="validateInput(identifying_marks, 0, 'letters')" onblur="checkErrorMessage(identifying_marks)" required>
                        <p class="input_error text-red-600"></p>
                        @error('identifying_marks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="person_with_disability">Is PWD?<sup>*</sup></label>
                        <input type="search" id="person_with_disability" list="person_with_disability_choices" name="person_with_disability" value="{{ old('person_with_disability') ?? ($healthRecord->handicap ?? '') }}" required>
                        <datalist id="person_with_disability_choices">
                            @foreach ($pwds as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                            @endforeach
        
                        </datalist>
                    </div>

                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateHealthRecordsButton" onclick="openConfirmationDialog(this, 'Confirm Health Record', 'Are you sure you want to save this changes?')">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Historical Record of Medical Condition
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                <div class="mb-3">
                    <label>Medical Condition/Illness</label>
                </div>

                <div class="mb-3">
                    <label for="date">Date</label>
                </div>

                <div class="mb-3">
                    <label>Add</label>
                </div>

            </div>

            <form action="{{ route('health-record.store', ['cesno'=>$mainProfile->cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <input id="medical_condition_illness" name="medical_condition_illness" type="text">
                        @error('medical_condition_illness')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="date" id="medical_date" name="date" oninput="validateDateInput(medical_date)">
                        <p class="input_error text-red-600"></p>
                        @error('date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" id="add" class="btn btn-primary mt-1">
                            +
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div> --}}

<div class="table-history-health-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Medical Condition/Illness
                </th>

                <th scope="col" class="px-6 py-3">
                    Date
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @if (count($medicalHistory) > 0)
                @foreach ($medicalHistory as $histories)
                    <tr class="border-b bg-white">

                        <td class="px-6 py-3">
                            {{ $histories->illness }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $histories->illness_date }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                {{-- <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a> --}}
                                <form action="{{ route('medical-history.destroy', ['ctrlno'=>$histories->ctrlno]) }}" method="POST" id="delete_medical_history_form{{$histories->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteMedicalHistoryButton{{$histories->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon
                                            src="https://cdn.lordicon.com/jmkrnisz.json"
                                            trigger="hover"
                                            colors="primary:#880808"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-b bg-white">
                    <td colspan="3" class="px-6 py-3 text-center bg-neutral-100">No Records</td>
                </tr>
            @endif
            

        </tbody>
    </table>

    <div class="flex justify-end m-3">
        <button id="add_medical_history" class="btn btn-primary">
            Add
        </button>
    </div>
    
</div>

@endsection