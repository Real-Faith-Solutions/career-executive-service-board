@extends('layouts.app')
@section('title', 'Edit Personal Data')
@section('sub', 'Edit Personal Data')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $mainProfile->cesno])

<div class="grid-rows-7 grid lg:grid-cols-3 sm:grid-cols-1 gap-1">

    <form class="col-span-3" action="{{ route('edit-profile-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="edit_personal_data" method="POST" onsubmit="return checkErrorsBeforeSubmit(edit_personal_data)">

        @csrf

        <div class="col-span-3">
            <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
                <div class="w-full text-left text-gray-500">
                    <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                        <h1 class="px-6 py-3 text-left">
                            Edit Personal Data
                        </h1>
                        <a href="{{ route('personal-data.show', ['cesno' => $mainProfile->cesno]) }}" class="px-6 py-3 text-right">Back</a>
                    </div>

                    <div class="border-b bg-white px-6 py-3">

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                            <div class="mb-3">
                                <label for="cesno">CES Number</label>
                                <input id="cesno" name="cesno" readonly type="number" value="{{ $mainProfile->cesno }}">
                            </div>

                            <div class="mb-3">
                                <label for="status">Record Status<sup>*</span></label>
                                <select id="status" name="status" required>
                                    @foreach ($recordStatus as $data)
                                        @if ($data->name == $mainProfile->status)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email<sup>*</span></label>
                                <input id="email" name="email" readonly value="{{ $mainProfile->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="title">Title<sup>*</sup></label>
                                <select id="title" name="title" required>
                                    @foreach ($title as $data)
                                        @if ($data->name == $mainProfile->title)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lastname">Lastname<sup>*</sup></label>
                                <input id="lastname" name="lastname" type="text" value="{{ $mainProfile->lastname }}" oninput="validateInput(lastname, 2, 'letters')" onkeypress="validateInput(lastname, 2, 'letters')" onblur="checkErrorMessage(lastname)" required>
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="firstname">Firstname<sup>*</sup></label>
                                <input id="firstname" name="firstname" type="text" value="{{ $mainProfile->firstname }}" oninput="validateInput(firstname, 2, 'letters')" onkeypress="validateInput(firstname, 2, 'letters')" onblur="checkErrorMessage(firstname)" required>
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="middlename">Middlename<sup>*</sup></label>
                                <input id="middlename" name="middlename" type="text" value="{{ $mainProfile->middlename }}" onkeyup="generateMiddleInitial()" type="text" oninput="validateInput(middlename, 2, 'letters')" onkeypress="validateInput(middlename, 2, 'letters')" onblur="checkErrorMessage(middlename)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="mi">Middle initial<sup>*</sup></label>
                                <input id="mi" name="mi" readonly type="text" value="{{ $mainProfile->mi }}">
                            </div> --}}

                            <div class="mb-3">
                                <label for="name_extension">Name Extension</label>
                                <input id="name_extension" list="name_extension_choices" name="name_extension" value="{{ $mainProfile->name_extension }}" type="search">
                                <datalist id="name_extension_choices">
                                    @foreach ($nameExtensions as $data)
                                        @if ($data->name == $mainProfile->name_extension)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="nickname">Nickname</label>
                                <input id="nickname" name="nickname" type="text" value="{{ $mainProfile->nickname }}" oninput="validateInput(nickname, 0, 'letters')" onkeypress="validateInput(nickname, 0, 'letters')" onblur="checkErrorMessage(nickname)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="birthdate">Birthdate<sup>*</sup></label>
                                <input type="date" id="birthdateEdit" name="birthdate" onchange="computeAgeEdit()" oninput="validateDateInput(birthdate, 18)" value="{{ $mainProfile->birth_date ? \Carbon\Carbon::parse($mainProfile->birth_date)->format('Y-m-d') : now()->format('Y-m-d') }}" required>
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="age">Age<sup class="text-danger">*</sup></label>
                                <input id="ageEdit" name="age" readonly type="number">
                            </div>

                            <div class="mb-3">
                                <label for="birth_place">Birth Place<sup>*</sup></label>
                                <input id="birth_place" name="birth_place" type="text" value="{{ $mainProfile->birth_place }}" oninput="validateInput(birth_place, 2)" onkeypress="validateInput(birth_place, 2)" onblur="checkErrorMessage(birth_place)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="gender">Gender By Birth<sup>*</sup></label>
                                <select id="gender" name="gender" required>
                                    @foreach ($genderByBirths as $data)
                                        @if ($data->name == $mainProfile->gender)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
                                <input id="gender_by_choice" list="gender_by_choice_choices" name="gender_by_choice" value="{{ $mainProfile->gender_by_choice }}" required type="search">
                                <datalist id="gender_by_choice_choices">
                                    @foreach ($genderByChoices as $data)
                                        @if ($data->name == $mainProfile->gender_by_choice)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="civil_status">Civil Status<sup>*</sup></label>
                                <select id="civil_status" name="civil_status" required>
                                    @foreach ($civilStatus as $data)
                                        @if ($data->name == $mainProfile->civil_status)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="religion">Religion<sup>*</sup></label>
                                <input list="religion_choices" id="religion" name="religion" value="{{ $mainProfile->religion }}">
                                <datalist id="religion_choices">
                                    @foreach ($religion as $data)
                                        @if ($data->name == $mainProfile->religion)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="height">Height (in meters)<sup>*</sup></label>
                                <input id="profile_height" name="height" type="text" value="{{ $mainProfile->height }}" oninput="validateInput(profile_height, 2, 'numbersWithSpecial')" onkeypress="validateInput(profile_height, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(profile_height)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="weight">Weight (in kilograms)<sup>*</sup></label>
                                <input id="profile_weight" name="weight" type="text" value="{{ $mainProfile->weight }}" oninput="validateInput(profile_weight, 2, 'numbersWithSpecial')" onkeypress="validateInput(profile_weight, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(profile_weight)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
                                <input id="member_of_indigenous_group" list="member_of_indigenous_group_choices" name="member_of_indigenous_group" name="member_of_indigenous_group" value="{{ $mainProfile->member_of_indigenous_group }}" required type="search">
                                <datalist id="member_of_indigenous_group_choices">
                                    @foreach ($indigenousGroups as $data)
                                        @if ($data->name == $mainProfile->member_of_indigenous_group)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="single_parent">Solo Parent?<sup>*</sup></label>
                                <select class="w-100 form-control mb-3" id="single_parent" name="single_parent">
                                    @if ($mainProfile->single_parent == "Yes")
                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                    @else
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected>No</option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="person_with_disability">Is PWD?<sup>*</sup></label>
                                <input id="person_with_disability" list="person_with_disability_choices" name="person_with_disability" value="{{ $mainProfile->person_with_disability }}" required type="search">
                                <datalist id="person_with_disability_choices">
                                    @foreach ($pwds as $data)
                                        @if ($data->name == $mainProfile->person_with_disability)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="mb-3">
                                <label for="citizenship">Citizenship<sup>*</sup></label>
                                <select class="form-control w-100 citizenShip mb-3" id="editCitizenship" name="citizenship" onchange="toggleCitizenshipEdit()" required>
                                    @if ($mainProfile->citizenship == "Filipino")
                                        <option value="Filipino" selected>Filipino</option>
                                        <option value="Dual-Citizenship">Dual-Citizenship</option>
                                    @else
                                        <option value="Filipino">Filipino</option>
                                        <option value="Dual-Citizenship" selected>Dual-Citizenship</option>
                                    @endif
                                </select>
                            </div>
                            
                            <div class="mb-3" id="dualCitizenshipField" style="display: {{ $mainProfile->citizenship == 'Dual-Citizenship' ? 'block' : 'none' }}">
                                <label for="dual_citizenship">If has Dual Citizenship:</label>
                                <input id="dual_citizenship" list="dual_citizenship_choices" name="dual_citizenship" value="{{ $mainProfile->dual_citizenship }}" type="search">
                                <datalist id="dual_citizenship_choices">
                                    @foreach ($countries as $data)
                                        @if ($data->name == $mainProfile->dual_citizenship)
                                            <option value="{{ $data->name }}" selected>{{ $data->name }}</option>
                                        @else
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                        </div>

                        <div class="flex justify-end">
                            {{-- <button class="btn btn-primary" id="edit_profile_save" type="submit">Save</button> --}}
                            <button type="button" class="btn btn-primary" id="edit_profile_save" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to save this changes?')">
                                Save changes
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>

</div>



@endsection
