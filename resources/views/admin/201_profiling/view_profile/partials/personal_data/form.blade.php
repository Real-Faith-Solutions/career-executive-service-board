@extends('layouts.app')
@section('title', 'Personal Profile')
@section('sub', 'Personal Profile')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $mainProfile->cesno])

<div class="grid-rows-7 grid lg:grid-cols-4 sm:grid-cols-1 gap-1">

    <div class="flex flex-col items-center row-span-5 text-center">

        <img id="profile-avatar"
            class="profile-avatar w-50 h-50 rounded-full border-2 border-transparent hover:border-blue-500 cursor-pointer"
            src="{{ asset('images/'.($mainProfile->picture ?? 'placeholder.png')) }}" />

        <h1 class="text-bold text-2xl">
            {{ $mainProfile->title }} {{ $mainProfile->lastname }} {{ $mainProfile->firstname }} {{
            $mainProfile->extension_name }} {{ $mainProfile->middlename }}
        </h1>

        <span class="mr-2 rounded px-2.5 py-0.5 text-xs font-medium
            @if ($mainProfile->status === 'Active') bg-green-100 text-green-800 @endif
            @if ($mainProfile->status === 'Inactive') bg-orange-100 text-orange-800 @endif
            @if ($mainProfile->status === 'Retired') bg-blue-100 text-blue-800 @endif
            @if ($mainProfile->status === 'Deceased') bg-red-100 text-red-800 @endif
            ">
            {{ $mainProfile->status }}
        </span>

        {{-- <p>CES number: {{ $mainProfile->cesno }}</p> --}}
    </div>

    <div class="col-span-3">
        <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
            <div class="w-full text-left text-gray-500">
                <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                    <h1 class="px-6 py-3 text-left">
                        Personal Data
                    </h1>
                    <a href="{{ route('profile.edit', ['cesno' => $mainProfile->cesno]) }}"
                        class="px-6 py-3 text-right">Edit</a>
                </div>

                <div class="border-b bg-white px-6 py-3">

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="cesno">CES Number</label>
                            <input id="cesno" name="cesno" readonly type="number" value="{{ $mainProfile->cesno }}">
                        </div>

                        <div class="mb-3">
                            <label for="status">Record Status<sup>*</span></label>
                            <input id="status" name="status" readonly value="{{ $mainProfile->status }}">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email<sup>*</span></label>
                            <input id="email" name="email" readonly value="{{ $mainProfile->email }}">
                        </div>

                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="title">Title<sup>*</sup></label>
                            <input id="title" name="title" readonly value="{{ $mainProfile->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="lastname">Lastname<sup>*</sup></label>
                            <input id="lastname" name="lastname" readonly type="text"
                                value="{{ $mainProfile->lastname }}">
                        </div>

                        <div class="mb-3">
                            <label for="firstname">Firstname<sup>*</sup></label>
                            <input id="firstname" name="firstname" readonly type="text"
                                value="{{ $mainProfile->firstname }}">
                        </div>

                        <div class="mb-3">
                            <label for="middlename">Middlename<sup>*</sup></label>
                            <input id="middlename" name="middlename" readonly type="text"
                                value="{{ $mainProfile->middlename }}">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="mi">Middle initial<sup>*</sup></label>
                            <input id="mi" name="mi" readonly type="text" value="{{ $mainProfile->mi }}">
                        </div> --}}

                        <div class="mb-3">
                            <label for="name_extension">Name Extension</label>
                            <input id="name_extension" name="name_extension" readonly
                                value="{{ $mainProfile->name_extension }}">
                        </div>

                        <div class="mb-3">
                            <label for="nickname">Nickname</label>
                            <input id="nickname" name="nickname" readonly type="text"
                                value="{{ $mainProfile->nickname }}">
                        </div>

                        <div class="mb-3">
                            <label for="personal_birthdate">Birthdate<sup>*</sup></label>
                            <input id="personal_birthdate" name="birthdate" readonly type="text"
                                value="{{ \Carbon\Carbon::parse($mainProfile->birth_date)->format('F d, Y') }}">
                        </div>

                        <div class="mb-3">
                            <label for="personal_age">Age<sup class="text-danger">*</sup></label>
                            <input id="personal_age" name="age" value="{{ $age }}" readonly type="number">
                        </div>

                        <div class="mb-3">
                            <label for="birth_place">Birth Place<sup>*</sup></label>
                            <input id="birth_place" name="birth_place" readonly type="text"
                                value="{{ $mainProfile->birth_place }}">
                        </div>

                        <div class="mb-3">
                            <label for="gender">Gender By Birth<sup>*</sup></label>
                            <input id="gender" name="gender" readonly value="{{ $mainProfile->gender }}">
                        </div>

                        <div class="mb-3">
                            <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
                            <input id="gender_by_choice" name="gender_by_choice" readonly
                                value="{{ $mainProfile->gender_by_choice }}">
                        </div>

                        <div class="mb-3">
                            <label for="civil_status">Civil Status<sup>*</sup></label>
                            <input id="civil_status" name="civil_status" readonly
                                value="{{ $mainProfile->civil_status }}">
                        </div>

                        <div class="mb-3">
                            <label for="religion">Religion<sup>*</sup></label>
                            <input id="religion" name="religion" readonly value="{{ $mainProfile->religion }}">
                        </div>

                        <div class="mb-3">
                            <label for="height">Height (in meters)<sup>*</sup></label>
                            <input id="height" name="height" readonly type="text" value="{{ $mainProfile->height }}">
                        </div>

                        <div class="mb-3">
                            <label for="weight">Weight (in kilograms)<sup>*</sup></label>
                            <input id="weight" name="weight" readonly type="text" value="{{ $mainProfile->weight }}">
                        </div>

                        <div class="mb-3">
                            <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
                            <input id="member_of_indigenous_group" name="member_of_indigenous_group"
                                value="{{ $mainProfile->member_of_indigenous_group }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="single_parent">Solo Parent?<sup>*</sup></label>
                            <input id="single_parent" name="sp" readonly value="{{ $mainProfile->single_parent }}">
                        </div>

                        <div class="mb-3">
                            <label class="ml-2 text-sm font-medium text-gray-900" for="person_with_disability">is
                                PWD?</label>
                            <input id="person_with_disability" name="person_with_disability" readonly
                                value="{{ $mainProfile->person_with_disability }}">
                        </div>

                        <div class="mb-3">
                            <label for="citizenship">Citizenship<sup>*</sup></label>
                            <input id="citizenship" name="citizenship" readonly value="{{ $mainProfile->citizenship }}">
                        </div>

                        <div class="mb-3"
                            style="display: {{ $mainProfile->citizenship == 'Dual-Citizenship' ? 'block' : 'none' }}">
                            <label for="dual_citizenship">If Holder Dual Citizenship By Birth, By Naturalization</label>
                            <input id="dual_citizenship" name="dual_citizenship" readonly type="text"
                                value="{{ $mainProfile->dual_citizenship }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection